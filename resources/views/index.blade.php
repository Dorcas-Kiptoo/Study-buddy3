<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    @include('header')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Welcome to Study Buddy</h1>
            <h1 class="text-white display-1 mb-5">Your Path to Academic Excellence</h1>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/mresh.jpeg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">About Us</h6>
                        <h1 class="display-4">First Choice For Online Education Anywhere</h1>
                    </div>
                    <p>The Study Buddy is a web app that aims to serve students across the country by connecting them with qualified tutors in various subjects. The app has a user-friendly interface where students can register, search for tutors based on what subject they want assistance in, schedule tutoring sessions with tutors having agreed on the payment and provide feedback about the tutor promoting quality assurance.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Why Choose Us?
                        </h6>
                        <h1 class="display-4">Why You Should Start Learning with Us?</h1>
                    </div>
                    <p class="mb-4 pb-2">Study Buddy provides a condusive environment for all learners across the country connecting them to qualified tutors any day and any time.</p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Skilled Instructors</h4>
                            <p>Tutors are critically vetted and intricately chosen to serve as our educators providing quality education to all students.</p>
                        </div>
                    </div>
                   
                       
                
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Online Classes</h4>
                            <p class="m-0">Study Buddy provides an online platform where the educators can meet students regardless of their location ensuring it caters to all students country wide.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Courses</h6>
                    <h1 class="display-4">Checkout New Releases Of Our Courses</h1>
                </div>
            </div>
        </div>
        <div class="owl-carousel courses-carousel">
            @foreach ($courses as $course)
                @foreach ($course->tutors as $tutor)
                    <div class="courses-item position-relative">
                        <img class="img-fluid" src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}"
                            style="height:400px; width:500px;">
                        <div class="courses-text">
                            <h4 class="text-center text-white px-3">{{ $course->name }}</h4>
                            <div class="border-top w-100 mt-3">
                                <div class="d-flex justify-content-between p-4">
                                    <span class="text-white"><i class="fa fa-user mr-2"></i>{{ $tutor->name }}</span>
                                    <span class="text-warning mr-2"><i class="fa fa-star"></i>
                                        {{ number_format($tutor->rating, 1) }}</span>
                                </div>
                            </div>
                            <div class="w-100 bg-white text-center p-4">
                                <a class="btn btn-primary"
                                    href="{{ url('/subject-detail/' . $course->id . '/' . $tutor->id) }}">Course Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
    <!-- Courses End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Instructors</h6>
                <h1 class="display-4">Meet Our Instructors</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                @foreach ($tutors as $tutor)
                    <div class="team-item">
                        <img class="img-fluid w-100" src="{{ asset('storage/' . $tutor->profile_photo) }}"
                            alt="{{ $tutor->name }}">
                        <div class="bg-light text-center p-4">
                            <h5 class="mb-3">{{ $tutor->name }}</h5>
                            <p class="mb-2">{{ $tutor->subjects->pluck('name')->join(', ') }}</p>
                            <p class="mb-2">{{ $tutor->contact_info }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid bg-image py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Testimonial</h6>
                        <h1 class="display-4">What Our Students Say</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div class="bg-white p-5">
                                <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                                <p>{{ $testimonial->comments }}</p>
                                <div class="d-flex flex-shrink-0 align-items-center mt-4">
                                    <img class="img-fluid mr-4"
                                        src="{{ asset('storage/' . $testimonial->session->student->profile_photo) }}"
                                        alt="{{ $testimonial->session->student->name }}">
                                    <div>
                                        <h5>{{ $testimonial->session->student->name }}</h5>
                                        <span>{{ $testimonial->session->subject->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    @include('footer')

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
    </script>

    <!-- Libraries Scripts -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.courses-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            $('.team-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            $('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 2
                    }
                }
            });
        });
    </script>
</body>

</html>