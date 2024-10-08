<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('../../bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('../../dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('../../plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />


</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b> Login</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @include('includes.alert-message')

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group has-feedback @error('email') has-error @enderror">
                    <input type="text" name="email" class="form-control" placeholder="Email" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                        <label class="control-label" for="inputError"><i
                                class="fa fa-times-circle-o"></i>{{ $message }}</label>
                    @enderror
                </div>


                <div class="form-group has-feedback @error('password') has-error @enderror">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                        <label class="control-label" for="inputError"><i
                                class="fa fa-times-circle-o"></i>{{ $message }}</label>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>


            <a href="">I forgot my password</a><br>
            <a href="{{ route('login.google') }}" class="btn btn-primary">Login with google </a>


        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('../../plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('../../bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('../../plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
