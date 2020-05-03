<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin :: @yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body style="">

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="login-wrapper d-flex justify-content-center .align-items-center flex-column">
                <h3 class="text-center font-weight-bold text-logo">Akawo</h3>
                <div class="login-box align-items-center">

                    <form action="/login" method="POST" id="form">
                        <div class="formheadercontainer">
                            <span class="formheadertext">Sign in to your account</span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email</label>
                            <input type="email" class="form-control form-control-lg" value="" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password</label>
                            <input type="password" class="form-control form-control-lg" value="" id="password" name="password">
                        </div>
                        <div class="fpassword">
                            <a href="/passwordreset">Forgot your password?</a>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
                        <div class="loginregtext">
                            <a href="/register">Don't have an account? Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
