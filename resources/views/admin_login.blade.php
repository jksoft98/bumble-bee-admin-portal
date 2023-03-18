<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/theme-default/dist/img/bumble-bee-logo.png">
  <title>Bumble Bee | Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="/assets/theme-default/plugins/toastr/toastr.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/theme-default/dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="/assets/custom/css/custom-style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <a href="/"><img src="/assets/theme-default/dist/img/bee-main-logo.png" alt="" style="width:100%"></a>
      <hr>
      <p class="login-box-msg mt-1" style="padding:0px">Login in to start your session</p>
      <form action="/admin-login-submit" method="post" id="admin-login-form">
        @csrf
        <div class="input-group mt-3 mb-3">
          <input type="email" class="form-control laxEmail" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control pass" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-dark btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-0">
        <a href="/customer-register" class="text-center">Register a new customer</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/assets/theme-default/plugins/jquery/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/assets/theme-default/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/assets/theme-default/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/theme-default/dist/js/adminlte.min.js"></script>

<!-- Custom style -->
<script src="/assets/custom/js/form-validation-init.js"></script>

@if (session('error'))
    <script>
        $( document ).ready(function() {
          toastr.error( "{{ session('error') }}")
        });
    </script>
@endif
</body>
</html>
