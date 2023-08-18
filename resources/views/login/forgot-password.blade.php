<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aung Myin Clinic Manager</title>
    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <div class="container col-sm-12 col-md-5" style="margin-top: 120px;">
        <div class="card shadow-sm bg-body rounded">
            <div class="rounded-top d-flex align-items-center justify-content-center p-3" style="background-color: {{config('app.color')}}; gap: 10px;">
                <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="img-fluid" style="width: 50px;">
                <div class="text-white">
                    <h3>Aung Myin</h3>
                    <span style="font-size: 0.8rem;">Clinic Manager</span>
                </div>
            </div>
            @if (Session::has('success'))
            @include('partials._toast')
            @endif
            <form action="{{ route('password.email') }}" method="post" class="p-5">
                @csrf
                <p class="small p-2" style="background-color: {{config('app.bg_color')}}">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email address">

                    @error('email') <span class="text-danger alert-msg small">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn px-4 text-white me-2" style="background-color: {{config('app.color')}}">Email Password Reset</button>
                <a class="text-reset small" href="{{ route('user-login') }}">Back to Login</a>
            </form>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    setInterval(function() {
        $(".alert-msg").fadeOut();
    }, 5000);
</script>

</html>