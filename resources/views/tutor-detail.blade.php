<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Tutor Detail</title>
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

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Tutor Detail</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Tutor Detail</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Detail Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Tutor Detail</h6>
                            <h1 class="display-4">John Doe</h1>
                        </div>
                        <img class="img-fluid rounded w-100 mb-4" src="img/team-1.jpg" alt="Image">
                        <p>Instructor Bio...</p>
                        
                        <p>Additional Information...</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="bg-primary mb-5 py-3">
                        <h3 class="text-white py-3 px-4 m-0">Tutor Features</h3>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Subjects</h6>
                            <h6 class="text-white my-3">Web Design, Development</h6>
                        </div>
                        <h5 class="text-white py-3 px-4 m-0">Available for Tutoring</h5>
                        <div class="py-3 px-4">
                            <a class="btn btn-block btn-secondary py-3 px-5" href="{{url('/book-lesson')}}">Book a Lesson</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->


    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->


</html>
