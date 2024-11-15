<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Admin Dashboard</title>
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
                <a href="#tutorsList" class="list-group-item list-group-item-action bg-light">Tutors List</a>
                <a href="#studentsList" class="list-group-item list-group-item-action bg-light">Students List</a>
                <a href="#recentSessions" class="list-group-item list-group-item-action bg-light">Recent Sessions</a>
                <a href="#subjectsList" class="list-group-item list-group-item-action bg-light">Subjects List</a>
                <a href="#payments" class="list-group-item list-group-item-action bg-light">Payments</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="container-fluid py-5">
            <!-- Dashboard Start -->
            <div id="dashboard" class="content-section container py-5" style="display:none;">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Admin:
                        {{ $admin->name }}
                    </h6>
                    <h1 class="display-4">Dashboard</h1>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Total Tutors</h6>
                            <h1 class="display-4">{{ $totalTutors }}</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Total Students</h6>
                            <h1 class="display-4">{{ $totalStudents }}</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Total Sessions</h6>
                            <h1 class="display-4">{{ $totalSessions }}</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="bg-light text-center p-4">
                            <h6 class="text-uppercase">Pending Approvals</h6>
                            <h1 class="display-4">{{ $pendingApprovals }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard End -->

            <!-- Tutors List Start -->
            <div id="tutorsList" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Tutors List</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tutors as $tutor)
                                <tr>
                                    <td>{{ $tutor->name }}</td>
                                    <td>{{ $tutor->email }}</td>
                                    <td>{{ number_format($tutor->rating, 1) }}</td>
                                    <td>
                                        @if ($tutor->status == 'Unverified')
                                            <button class="btn btn-primary btn-sm"
                                                onclick="approveTutor({{ $tutor->id }})">Approve</button>
                                        @else
                                            <span class="badge badge-success">Verified</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No tutors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Tutors List End -->

            <!-- Students List Start -->
            <div id="studentsList" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Students List</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Students List End -->

            <!-- Recent Sessions Start -->
            <div id="recentSessions" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Recent Sessions</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Tutor Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentSessions as $session)
                                <tr>
                                    <td>{{ $session->student->name }}</td>
                                    <td>{{ $session->tutor->name }}</td>
                                    <td>{{ $session->subject->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($session->session_time)->format('Y-m-d H:i') }}</td>
                                    <td>{{ ucfirst($session->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No recent sessions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Recent Sessions End -->

            <!-- Subjects List Start -->
            <div id="subjectsList" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <h4 class="text-uppercase">Subjects List</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>
                                        @if ($subject->description)
                                            {{ $subject->description }}
                                        @else
                                            <span>Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($subject->image)
                                            <img src="{{ asset('storage/' . $subject->image) }}" alt="Subject Image"
                                                style="width: 50px; height: 50px;">
                                        @else
                                            <span>Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" style="margin-bottom:10px"
                                            onclick="addDescription({{ $subject->id }})">Set Description</button>
                                        <button class="btn btn-primary btn-sm" style="margin-bottom:10px"
                                            onclick="addImage({{ $subject->id }})">Set Image</button>
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
            <!-- Subjects List End -->

            <!-- Payments Start -->
            <div id="payments" class="content-section" style="display:none;">
                <div class="bg-light p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-uppercase">Payments</h4>
                        <button id="downloadPdfAdmin" class="btn btn-outline-secondary btn-sm"><i
                                class="fas fa-file-pdf"></i> Download as a PDF</button>
                    </div>
                    <table class="table table-striped" id="adminPaymentsTable">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Tutor</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->student->name }}</td>
                                    <td>{{ $payment->tutor->name }}</td>
                                    <td>Ksh {{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d H:i a') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No payments found.</td>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        $('#downloadPdfAdmin').click(function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.autoTable({ html: '#adminPaymentsTable' });
            doc.save('admin_payments.pdf');
        });

        function approveTutor(tutorId) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You are about to approve this tutor.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/approve-tutor/${tutorId}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            swalWithBootstrapButtons.fire(
                                "Approved!",
                                "Tutor has been approved.",
                                "success"
                            ).then(() => {
                                location.href = '#tutorsList';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            swalWithBootstrapButtons.fire(
                                "Error!",
                                "There was an error approving the tutor.",
                                "error"
                            );
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Tutor approval was cancelled.",
                        "error"
                    );
                }
            });
        }

        function addImage(subjectId) {
            Swal.fire({
                title: 'Select image',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/*',
                    'aria-label': 'Upload subject image'
                }
            }).then((result) => {
                if (result.value) {
                    const file = result.value;
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: `/subjects/${subjectId}/add-image`,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire(
                                'Uploaded!',
                                'Subject image has been added.',
                                'success'
                            ).then(() => {
                                location.href = '#subjectsList';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'There was an error uploading the image.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function addDescription(subjectId) {
            Swal.fire({
                input: 'textarea',
                inputLabel: 'Add Description',
                inputPlaceholder: 'Type your description here...',
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    const description = result.value;
                    $.ajax({
                        url: `/subjects/${subjectId}/add-description`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            description: description
                        },
                        success: function (response) {
                            Swal.fire(
                                'Added!',
                                'Description has been added.',
                                'success'
                            ).then(() => {
                                location.href = '#subjectsList';
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'There was an error adding the description.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

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