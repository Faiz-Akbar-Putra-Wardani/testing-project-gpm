<!doctype html>
<html lang="en">
<head>
    <title>GPM - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
</head>
<body>
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center mt-3">
                        <img src="{{ asset('assets/images/gpm.png') }}?v={{ time() }}" alt="image" class="brand-logo" height="90" />
                    </a>
                    <div class="d-flex justify-content-center">
                        <div class="auth-header text-center">
                            <h2 class="text-secondary mt-5"><b>Login</b></h2>
                            <p class="f-16 mt-2">Silahkan masukan akun anda</p>
                        </div>
                    </div>
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required />
                            <label>Email Address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                            <label>Password</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vendor Scripts -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

@vite('resources/js/app.js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            window.showSuccess(@json(session('success')));
        @endif

        @if(session('error'))
            window.showError(@json(session('error')));
        @endif

        @if($errors->any())
            window.showValidationErrors(@json($errors->all()));
        @endif
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    layout_change('light');
    font_change('Roboto');
    change_box_container('false');
    layout_caption_change('true');
    layout_rtl_change('false');
    preset_change('preset-1');
});
</script>
</body>
</html>
