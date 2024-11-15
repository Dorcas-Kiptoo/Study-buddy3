<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Our Verified Tutors</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Online Education, Tutoring" name="keywords">
    <meta content="Study Buddy - Online Tutoring Platform" name="description">

    <!-- Favicon -->
    <link href="img/study-buddy-favicon-color.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('header')
    <!-- Navbar End -->

    <!-- Instructors Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Instructors</h6>
                <h1 class="display-4">Meet Our Instructors</h1>
            </div>
            <div class="row">
                @foreach ($tutors as $tutor)
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="{{ asset('storage/' . $tutor->profile_photo) }}" alt="{{ $tutor->name }}">
                        <div class="bg-light text-center p-4">
                            <h5 class="mb-3">{{ $tutor->name }}</h5>
                            <p class="mb-2">
                                @foreach ($tutor->subjects as $subject)
                                    {{ $subject->name }}@if (!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="mb-2">{{ $tutor->contact_info }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg justify-content-center mb-0">
                        {{ $tutors->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Instructors End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

</body>

</html>
