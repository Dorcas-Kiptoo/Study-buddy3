<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Rate Session</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Online Education, Tutoring" name="keywords">
    <meta content="Study Buddy - Online Tutoring Platform" name="description">

    <!-- Favicon -->
    <link href="img/study-buddy-favicon-color.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('header')
    <!-- Navbar End -->

    <!-- Rate Session Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Rate Session</h6>
                <h1 class="display-4">Session with {{ $session->tutor->name }}</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-light p-4">
                        <form id="rate-session-form" method="POST" action="{{ route('rate-session', $session->id) }}">
                            @csrf
                            <div class="form-group">
                                <input type="number" class="form-control bg-light border-0" id="rating" name="rating" placeholder="Rating (1 to 5)"
                                    min="1" max="5" style="padding: 30px 20px;">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control bg-light border-0" id="comments" name="comments" rows="4"placeholder="Comments"
                                    style="padding: 30px 20px;"></textarea>
                            </div>
                            <button class="btn btn-primary py-3 px-5" type="submit">Submit Rating</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rate Session End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#rate-session-form').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route("rate-session", $session->id) }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Feedback submitted successfully'
                    }).then(() => {
                        window.location.href = '{{ route("student-dashboard") }}';
                    });
                },
                error: function (error) {
                    Swal.fire(
                        'Error!',
                        'There was an error submitting the feedback. Please try again.',
                        'error'
                    );
                }
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
</body>

</html>