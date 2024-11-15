<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Book a Lesson</title>
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

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('header')
    <!-- Navbar End -->

    <!-- Book Lesson Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Book a
                                Lesson</h6>
                            <h1 class="display-4">Select a Session Time</h1>
                        </div>
                        <div id="calendar"></div>
                        <form id="booking-form">
                            @csrf 
                            <div class="form-group">
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                <input type="hidden" name="duration" value="{{ $tutorSubject->duration }}">
                                <label for="date">Choose a date and time:</label>
                                <input type="datetime-local" class="form-control" id="session_time" name="session_time"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Book Lesson End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
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

            $('#booking-form').submit(function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                Swal.fire({
                    title: 'Are you sure you want to book this session?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, book it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/book-session') }}",
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                Swal.fire(
                                    'Booked!',
                                    'Your session has been booked.',
                                    'success'
                                ).then(() => {
                                    window.location.href = "{{ url('/dashboard') }}";
                                });
                            },
                            error: function (error) {
                                Swal.fire(
                                    'Error!',
                                        error.responseJSON.message,
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>