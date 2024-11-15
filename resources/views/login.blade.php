<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Login</title>
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

    <!-- Login Form Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 450px;">
                        <h1 class="text-center mb-4">Login</h1>
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                            <div class="form-group">
                                <input type="email" class="form-control bg-light border-0" name="email" placeholder="Your Email" style="padding: 30px 20px;" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control bg-light border-0" name="password" placeholder="Your Password" style="padding: 30px 20px;" required>
                            </div>
                            <button class="btn btn-primary py-3 px-5 d-block mx-auto" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Form End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->
    
    <script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });

    @if (session('status'))
    Toast.fire({
        icon: "success",
        title: "{{ session('status') }}"
    });
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    Toast.fire({
        icon: "error",
        title: "{{ $error }}"
    });
    @endforeach
    @endif

    @if (session('error'))
    Toast.fire({
        icon: "error",
        title: "{{ session('error') }}"
    });
    @endif
    </script>

</body>

</html>
