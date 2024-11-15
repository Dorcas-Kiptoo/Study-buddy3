<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Tutor Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Online Education, Tutoring" name="keywords">
    <meta content="Study Buddy - Online Tutoring Platform" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('img/study-buddy-favicon-color.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    @include('header')

    <!-- Sidebar Start -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <a href="#dashboard" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a href="#upcomingSessions" class="list-group-item list-group-item-action bg-light">Upcoming
                    Sessions</a>
                <a href="#completedSessions" class="list-group-item list-group-item-action bg-light">Completed
                    Sessions</a>
                <a href="#payments" class="list-group-item list-group-item-action bg-light">Payments Received</a>
                <a href="#subjects" class="list-group-item list-group-item-action bg-light">Subjects</a>
                <a href="#availability" class="list-group-item list-group-item-action bg-light">Set Availability</a>
                <a href="#ratings" class="list-group-item list-group-item-action bg-light">Ratings</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="container-fluid py-5">
            <!-- Dashboard Start -->
            <div id="dashboard" class="content-section container py-5" style="display:none;">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Tutor:
                        {{ $tutor->name }}
                    </h6>
                    <h1 class="display-4">Dashboard</h1>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Total Sessions</h6>
                            <h1 class="display-4">{{ $totalSessions }}</h1>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Average Rating</h6>
                            <h1 class="display-4">{{ number_format($averageRating, 1) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard End -->

            <!-- Upcoming Sessions Start -->
            <div id="upcomingSessions" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Upcoming Sessions</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Meet Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($upcomingSessions as $session)
                                <tr>
                                    <td>{{ $session->student->name }}</td>
                                    <td>{{ $session->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('H:i A') }}</td>
                                    <td>
                                        @if($session->google_meet_link)
                                            <a href="{{ $session->google_meet_link }}" target="_blank">Join Meeting</a>
                                        @else
                                            <button class="btn btn-primary btn-sm" onclick="addMeetLink({{ $session->id }})">Add
                                                Meet Link</button>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm"
                                            onclick="completeSession({{ $session->id }})">Complete</button>
                                    </td>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No upcoming sessions.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Upcoming Sessions End -->

            <!-- Completed Sessions Start -->
            <div id="completedSessions" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Completed Sessions</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($completedSessions as $session)
                                <tr>
                                    <td>{{ $session->student->name }}</td>
                                    <td>{{ $session->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('H:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No completed sessions.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Completed Sessions End -->

            <!-- Payments Start -->
            <div id="payments" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-uppercase">Payments Received</h4>
                        <button id="downloadPdfTutor" class="btn btn-outline-secondary btn-sm"><i
                                class="fas fa-file-pdf"></i> Download as a PDF</button>
                    </div>
                    <table class="table table-striped" id="tutorPaymentsTable">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->student->name }}</td>
                                    <td>Ksh {{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d H:i a') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Payments End -->

            <!-- Subjects Start -->
            <div id="subjects" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-uppercase">Subjects</h4>
                        <button class="btn btn-primary btn-sm" onclick="addSubject()">Add Subject</button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->pivot->price ?? 'Not set' }}</td>
                                    <td>{{ $subject->pivot->duration ? $subject->pivot->duration . ' minutes' : 'Not set' }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                            onclick="setPrice({{ $subject->id }}, {{ $subject->pivot->price ?? 'null' }})">Set
                                            Price</button>
                                        <button class="btn btn-secondary btn-sm"
                                            onclick="setDuration({{ $subject->id }}, {{ $subject->pivot->duration ?? 'null' }})">Set
                                            Duration</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No subjects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Subjects End -->

            <!-- Availability Start -->
            <div id="availability" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Set Availability</h4>
                    <form id="availability-form">
                        @csrf
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="datetime-local" class="form-control bg-light border-0" id="start_time"
                                name="start_time" style="padding: 30px 20px;">
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="datetime-local" class="form-control bg-light border-0" id="end_time"
                                name="end_time" style="padding: 30px 20px;">
                        </div>
                        <button class="btn btn-primary py-3 px-5" type="submit">Set Availability</button>
                    </form>
                    <div class="mt-4">
                        <h5>Current Availabilities</h5>
                        <div id="availability-calendar"></div>
                    </div>
                </div>
            </div>
            <!-- Availability End -->

            <!-- Ratings Start -->
            <div id="ratings" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Ratings</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Rating</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tutor->feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->session->student->name }}</td>
                                    <td>{{ $feedback->rating }}</td>
                                    <td>{{ $feedback->comments }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No feedback found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Ratings End -->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- Sidebar End -->

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <script>
        @if(session('status'))
            Swal.fire({
                icon: 'success',
                title: "{{ session('status') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });
        @endif

        $('#menu-toggle').click(function () {
            $('#wrapper').toggleClass('toggled');
        });

        document.querySelectorAll('.list-group-item').forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.querySelector(this.getAttribute('href')).style.display = 'block';
            });
        });

        document.getElementById('downloadPdfTutor').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ html: '#tutorPaymentsTable' });
            doc.save('tutor_payments.pdf');
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('availability-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: @json($availabilities->map(function ($availability) {
    return [
        'title' => 'Available',
        'start' => $availability->start_time,
        'end' => $availability->end_time
    ];
}))
            });
            calendar.render();
        });

        function setPrice(subjectId, currentPrice) {
            const inputStep = 0.01;

            Swal.fire({
                title: 'Set Price',
                html: `
                    <input
                        type="number"
                        value="${currentPrice ?? 0}"
                        step="${inputStep}"
                        class="swal2-input"
                        id="range-value">`,
                input: 'range',
                inputValue: currentPrice ?? 0,
                inputAttributes: {
                    min: '0',
                    max: '1000',
                    step: inputStep.toString(),
                },
                didOpen: () => {
                    const inputRange = Swal.getInput();
                    const inputNumber = Swal.getPopup().querySelector('#range-value');

                    inputRange.style.width = '100%';

                    inputRange.addEventListener('input', () => {
                        inputNumber.value = inputRange.value;
                    });

                    inputNumber.addEventListener('change', () => {
                        inputRange.value = inputNumber.value;
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const price = document.getElementById('range-value').value;
                    $.ajax({
                        url: `/subjects/${subjectId}/set-price`,
                        type: 'POST',
                        data: {
                            price: price,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire('Set!', 'Price has been set.', 'success').then(() => {
                                location.href = '#subjects';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire('Error!', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }

        function setDuration(subjectId, currentDuration) {
            Swal.fire({
                title: 'Set Duration',
                input: 'number',
                inputLabel: 'Enter duration in minutes',
                inputValue: currentDuration ?? 0,
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value || value <= 0) {
                        return 'Please enter a valid duration!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const duration = result.value;
                    $.ajax({
                        url: `/subjects/${subjectId}/set-duration`,
                        type: 'POST',
                        data: {
                            duration: duration,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire('Set!', 'Duration has been set.', 'success').then(() => {
                                location.href = '#subjects';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire('Error!', 'There was an error setting the duration.', 'error');
                        }
                    });
                }
            });
        }

        function completeSession(sessionId) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You are about to mark this session as completed.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, complete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/sessions/${sessionId}/complete`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            swalWithBootstrapButtons.fire(
                                "Completed!",
                                "Session has been marked as completed.",
                                "success"
                            ).then(() => {
                                location.href = '#upcomingSessions';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            swalWithBootstrapButtons.fire(
                                "Error!",
                                "There was an error marking the session as completed.",
                                "error"
                            );
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Session marking was cancelled.",
                        "error"
                    );
                }
            });
        }

        function addMeetLink(sessionId) {
            Swal.fire({
                title: 'Add Google Meet Link',
                input: 'url',
                inputLabel: 'Enter Google Meet Link',
                inputPlaceholder: 'https://meet.google.com/xyz-abc-def',
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to enter a link!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const googleMeetLink = result.value;
                    $.ajax({
                        url: `/sessions/${sessionId}/add-meet-link`,
                        type: 'POST',
                        data: {
                            google_meet_link: googleMeetLink,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire('Added!', 'Meet link has been added.', 'success').then(() => {
                                location.href = '#upcomingSessions';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire('Error!', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }

        function addSubject() {
            Swal.fire({
                title: 'Add Subject',
                html: `
                    <input type="text" id="subject-name" class="swal2-input" placeholder="Subject Name">
                    <input type="number" id="subject-price" class="swal2-input" placeholder="Price">
                    <input type="number" id="subject-duration" class="swal2-input" placeholder="Duration in minutes">
                `,
                showCancelButton: true,
                preConfirm: () => {
                    const name = Swal.getPopup().querySelector('#subject-name').value;
                    const price = Swal.getPopup().querySelector('#subject-price').value;
                    const duration = Swal.getPopup().querySelector('#subject-duration').value;
                    if (!name || !price || !duration) {
                        Swal.showValidationMessage(`Please enter subject name, price and duration`);
                    }
                    return { name: name, price: price, duration: duration }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { name, price, duration } = result.value;
                    $.ajax({
                        url: `/subjects/add`,
                        type: 'POST',
                        data: {
                            name: name,
                            price: price,
                            duration: duration,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire('Added!', 'Subject has been added.', 'success').then(() => {
                                location.href = '#subjects';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire('Error!', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }

        $('#availability-form').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: `/availability/set`,
                type: 'POST',
                data: formData,
                success: function (response) {
                    Swal.fire('Set!', 'Availability has been set.', 'success').then(() => {
                        location.href = '#availability';
                        location.reload();
                    });
                },
                error: function (error) {
                    Swal.fire('Error!', error.responseJSON.message, 'error');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const section = window.location.hash.substr(1);
            if (section) {
                document.querySelectorAll('.content-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.getElementById(section).style.display = 'block';
            } else {
                document.getElementById('dashboard').style.display = 'block';
            }
        });
    </script>
</body>

</html>