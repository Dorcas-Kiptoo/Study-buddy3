<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>The Subjects We Offer</title>
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
    <!-- Navbar Start -->
    @include('header')
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Subjects</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ url('/') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Subjects</p>
            </div>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <form action="{{ url('/subject') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" name="search" style="padding: 30px 25px;"
                            placeholder="Keyword" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-secondary px-4 px-lg-5" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Courses Start -->
    <div class="container-fluid py-5" id="subjects-section">
        <div class="container py-5">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Subjects
                        </h6>
                        <h1 class="display-4">Checkout The Subjects Being Tutored</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($subjects as $subject)
                    @foreach ($subject->tutors as $tutor)
                        <div class="col-lg-4 col-md-6 pb-4">
                            <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                                href="{{ url('/subject-detail/' . $subject->id . '/' . $tutor->id) }}">
                                <img class="img-fluid" src="{{ asset('storage/' . $subject->image) }}"
                                    alt="{{ $subject->name }}" style="height:400px; width:500px;">
                                <div class="courses-text">
                                    <h4 class="text-center text-white px-3">{{ $subject->name }}</h4>
                                    <div class="border-top w-100 mt-3">
                                        <div class="d-flex justify-content-between p-4">
                                            <span class="text-white">
                                                <i class="fa fa-user mr-2"></i>{{ $tutor->name }} </span>
                                            <span class="text-white">
                                                @if ($tutor->rating)
                                                    <i
                                                        class="fa fa-star text-warning ml-2"></i> {{ number_format($tutor->rating, 1) }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @empty
                    <div class="col-12">
                        <p class="text-center">No subjects found.</p>
                    </div>
                @endforelse
            </div>
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg justify-content-center mb-0">
                        {{ $subjects->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.querySelector('form');
            searchForm.addEventListener('submit', function () {
                window.location.hash = '#subjects-section';
            });
        });
    </script>

</body>

</html>