<!doctype html>
<html lang="en">
<head>
    <title>GPM - Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center mt-3">
                        <img src="{{ asset('assets/images/gpm.png') }}" alt="logo" class="img-fluid brand-logo" />
                    </a>
                    <div class="d-flex justify-content-center">
                        <div class="auth-header text-center">
                            <h2 class="text-secondary mt-5"><b>Sign up</b></h2>
                            <p class="f-16 mt-2">Enter your credentials to continue</p>
                        </div>
                    </div>
                    <h5 class="my-4 d-flex justify-content-center">Sign Up with Email address</h5>
                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Name" required />
                            <label>Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required />
                            <label>Email Address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                            <label>Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required />
                            <label>Confirm Password</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Layout, font, container
    layout_change('light');
    font_change('Roboto');
    change_box_container('false');
    layout_caption_change('true');
    layout_rtl_change('false');
    preset_change('preset-1');

    // SweetAlert
    @if(session('success'))
        showSuccess('{{ session('success') }}');
    @endif

    @if(session('error'))
        showError('{{ session('error') }}');
    @endif

    @if($errors->any())
        showValidationErrors([
            @foreach ($errors->all() as $error)
                '{{ $error }}',
            @endforeach
        ]);
    @endif
});
</script>

</body>
</html>
