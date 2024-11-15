<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Study Buddy - Edit Profile</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('header')
    <!-- Navbar End -->

    <!-- Edit Profile Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Student</h6>
                <h1 class="display-4">Change Your Details</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-light p-4">
                        <form id="edit-profile-form">
                            @csrf
                            <div class="form-group text-center">
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo"
                                    class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                                <br>
                                <button type="button" class="btn btn-secondary btn-sm mt-2"
                                    onclick="changeProfilePhoto()">Change Photo</button>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control bg-light border-0" id="name" name="name"
                                    placeholder="Your Name" style="padding: 30px 20px;"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control bg-light border-0" id="email" name="email"
                                    placeholder="Your Email" style="padding: 30px 20px;"
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control bg-light border-0" id="phone" name="phone"
                                    placeholder="Your Phone Number" style="padding: 30px 20px;"
                                    value="{{ auth()->user()->contact_info }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control bg-light border-0" id="password"
                                    name="password" placeholder="Your New Password" style="padding: 30px 20px;">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control bg-light border-0" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Your New Password"
                                    style="padding: 30px 20px;">
                            </div>
                            <button class="btn btn-primary py-3 px-5" type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile End -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function changeProfilePhoto() {
            Swal.fire({
                title: 'Select image',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/*',
                    'aria-label': 'Upload profile photo'
                }
            }).then((result) => {
                if (result.value) {
                    const file = result.value;
                    const formData = new FormData();
                    formData.append('profile_photo', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: '/update-profile-photo',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Profile photo updated successfully'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'There was an error uploading the profile photo.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        $('#edit-profile-form').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '/update-profile',
                type: 'POST',
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully. Please log in again.'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                },
                error: function (error) {
                    Swal.fire(
                        'Error!',
                        'There was an error updating the details. Please try again.',
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