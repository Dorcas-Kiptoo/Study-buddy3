<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Register as Tutor</title>
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

    <!-- Register Form Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 850px;">
                        <h1 class="text-center mb-4">Register as a Tutor</h1>
                        <form action="{{ url('/register-tutor') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control bg-light border-0" placeholder="Your Name" style="padding: 30px 20px;" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control bg-light border-0" placeholder="Your Email" style="padding: 30px 20px;" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control bg-light border-0" placeholder="Password" style="padding: 30px 20px;" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation"  class="form-control bg-light border-0" placeholder="Re-enter Password" style="padding: 30px 20px;" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control bg-light border-0" placeholder="Your Phone Number" style="padding: 30px 20px;" required>
                            </div>
                            <div id="subjects-container" class="mb-4">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-light border-0" name="subjects[]" placeholder="Enter subject" style="padding: 30px 20px;">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-4" id="add-subject">Add Another Subject</button>
                            <div class="form-group">
                                <input type="file"  name="profile_photo" style="padding: 10px;" required>
                            </div>
                            <button class="btn btn-primary py-3 px-5 d-block mx-auto" type="submit">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form End -->

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
