@include('user.layouts.header')

<body class="img js-fullheight" style="background-image: url({{ url('/') }}/build/images/pasar1..jpg);">
    <form method="POST" action="{{ route('logged_in') }}" class="section">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Login</h3>
                        <form action="#" class="signin-form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" placeholder="Password"
                                    name="password" required>
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" name="remember_me" value="1" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('register-user') }}" style="color: #fff">Belum Punya akun!</a>
                                </div>
                            </div>
                        </form>
                        <p class="w-100 text-center">&mdash; Login dengan &mdash;</p>
                        <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span
                                    class="ion-logo-facebook mr-2"></span> Google</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span
                                    class="ion-logo-twitter mr-2"></span> facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ url('/') }}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/js/main.js"></script>

</body>

</html>
