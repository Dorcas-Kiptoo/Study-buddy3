<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TutorSession;
use App\Models\Feedback;
use App\Models\Subject;
use App\Models\TutorSubject;
use App\Models\TutorAvailability;
use App\Models\Payment;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TutorController extends Controller
{
    public function tutorDashboard()
    {
        $tutor = auth()->user();

        if ($tutor->status !== 'Verified') {
            return view('tutor-unverified');
        }

        $totalSessions = TutorSession::where('tutor_id', $tutor->id)->count();
        $averageRating = Feedback::whereHas('session', function ($query) use ($tutor) {
            $query->where('tutor_id', $tutor->id);
        })->avg('rating');
        $upcomingSessions = TutorSession::where('tutor_id', $tutor->id)
            ->where('status', 'booked')
            ->where('session_time', '>', now())
            ->get();
        $completedSessions = TutorSession::where('tutor_id', $tutor->id)
            ->where('status', 'completed')
            ->get();
        $subjects = $tutor->subjects()->withPivot('price', 'duration')->get();
        $allSubjects = Subject::all();
        $availabilities = TutorAvailability::where('tutor_id', $tutor->id)->get();
        $payments = Payment::where('tutor_id', $tutor->id)->get();

        return view('tutor-dashboard', compact('tutor', 'totalSessions', 'averageRating', 'upcomingSessions', 'completedSessions', 'subjects', 'allSubjects', 'availabilities', 'payments'));
    }

    public function setPrice(Request $request, $subjectId)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $tutor = auth()->user();

        TutorSubject::updateOrCreate(
            ['tutor_id' => $tutor->id, 'subject_id' => $subjectId],
            ['price' => $request->price]
        );

        return redirect()->route('tutor.dashboard', ['section' => 'subjects'])
            ->with('status', 'Price set successfully!');
    }

    public function setDuration(Request $request, $subjectId)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
        ]);

        $tutor = auth()->user();

        TutorSubject::updateOrCreate(
            ['tutor_id' => $tutor->id, 'subject_id' => $subjectId],
            ['duration' => $request->duration]
        );

        return redirect()->route('tutor.dashboard', ['section' => 'subjects'])
            ->with('status', 'Duration set successfully!');
    }

    public function completeSession($sessionId)
    {
        $session = TutorSession::findOrFail($sessionId);
        $session->status = 'completed';
        $session->save();

        return redirect()->route('tutor.dashboard', ['section' => 'upcomingSessions'])
            ->with('status', 'Session marked as completed.');
    }

    public function setAvailability(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $tutor = auth()->user();

            // Check for overlapping availability
            $overlap = TutorAvailability::where('tutor_id', $tutor->id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                        ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                        ->orWhere(function ($query) use ($request) {
                            $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                        });
                })->exists();

            if ($overlap) {
                return redirect()->route('tutor.dashboard', ['section' => 'availability'])
                    ->with('error', 'The availability range overlaps with an existing range.');
            }

            TutorAvailability::create([
                'tutor_id' => $tutor->id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            return redirect()->route('tutor.dashboard', ['section' => 'availability'])
                ->with('status', 'Availability set successfully!');
        } catch (\Exception $e) {
            Log::error('Error setting availability: ' . $e->getMessage());
            return redirect()->route('tutor.dashboard', ['section' => 'availability'])
                ->with('error', 'There was an error setting the availability.');
        }
    }

    public function addMeetLink(Request $request, $sessionId)
    {
        $request->validate([
            'google_meet_link' => 'required|url',
        ]);

        $session = TutorSession::findOrFail($sessionId);
        $session->google_meet_link = $request->google_meet_link;
        $session->save();

        // Notify the student
        UserNotification::create([
            'user_id' => $session->student_id,
            'message' => 'A Google Meet link has been added to your session with ' . $session->tutor->name,
            'is_read' => false,
        ]);

        return redirect()->route('tutor.dashboard', ['section' => 'upcomingSessions'])
            ->with('status', 'Meet link added successfully.');
    }

    public function addSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $tutor = auth()->user();

        // Check if the subject exists, if not, create it
        $subject = Subject::firstOrCreate(['name' => $request->name]);

        // Link the subject to the tutor with the provided price and duration
        TutorSubject::updateOrCreate(
            ['tutor_id' => $tutor->id, 'subject_id' => $subject->id],
            ['price' => $request->price, 'duration' => $request->duration]
        );

        return response()->json(['status' => 'success']);
    }

}
