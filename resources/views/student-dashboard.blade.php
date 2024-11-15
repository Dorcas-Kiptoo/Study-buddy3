<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Student Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Online Education, Tutoring" name="keywords">
    <meta content="Study Buddy - Online Tutoring Platform" name="description">

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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
                <a href="#payments" class="list-group-item list-group-item-action bg-light">Payments Made</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="container-fluid py-5">
            <!-- Dashboard Start -->
            <div id="dashboard" class="container py-5 content-section" style="display:none;">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Student:
                        {{ $student->name }}</h6>
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
                            <h6 class="text-uppercase">Completed Sessions</h6>
                            <h1 class="display-4">{{ $completedSessionsCount }}</h1>
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
                                <th>Tutor</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Meet Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($upcomingSessions as $session)
                                <tr>
                                    <td>{{ $session->tutor->name }}</td>
                                    <td>{{ $session->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('H:i A') }}</td>
                                    <td>
                                        @if($session->google_meet_link)
                                            <a href="{{ $session->google_meet_link }}" target="_blank">Join Meeting</a>
                                        @else
                                            No Link
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No upcoming sessions.</td>
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
                                <th>Tutor</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($completedSessions as $session)
                                <tr>
                                    <td>{{ $session->tutor->name }}</td>
                                    <td>{{ $session->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('Y-m-d') }}</td>
                                    <td>
                                        @if($session->feedback_id)
                                            Rated
                                        @else
                                            <a href="{{ url('/rate-session', $session->id) }}"
                                                class="btn btn-primary btn-sm">Rate</a>
                                        @endif
                                    </td>
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
                        <h4 class="text-uppercase">Payments Made</h4>
                        <button id="downloadPdfStudent" class="btn btn-outline-secondary btn-sm"><i
                                class="fas fa-file-pdf"></i> Download as a PDF</button>
                    </div>
                    <table class="table table-striped" id="studentPaymentsTable">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <td>Ksh {{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d H:i a') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Payments End -->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- Sidebar End -->

    @include('footer')

    <!-- jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <script>
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

        document.getElementById('downloadPdfStudent').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ html: '#studentPaymentsTable' });
            doc.save('student_payments.pdf');
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
