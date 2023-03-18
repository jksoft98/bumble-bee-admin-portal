<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- favicon -->
   <link rel="icon" type="image/png" sizes="16x16" href="/assets/theme-default/dist/img/bumble-bee-logo.png">
  <title>Bumble Bee | Customer Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/fontawesome-free/css/all.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Toastr style -->
  <link rel="stylesheet" href="/assets/theme-default/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/theme-default/dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="/assets/custom/css/custom-style.css">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <!-- <div class="register-logo signin-logo">
    <a href="/"><img src="/assets/theme-default/dist/img/bumble-bee-logo.png" alt=""></a>
  </div> -->

  <div class="card">
    <div class="card-body register-card-body">
    <a href="/"><img src="/assets/theme-default/dist/img/bee-main-logo.png" alt="" style="width:100%"></a>
      <hr>
      <p class="login-box-msg mt-1" style="padding:0px">Register a new customer</p>
      <!-- <p class="login-box-msg">Register a new customer</p> -->
      <form action="/customer-register-submit" method="post" id="customer-register-form">
        @csrf
        <div class="input-group mt-3 mb-3">
          <input type="text" class="form-control phone" placeholder="Phone Number" name="phone" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone-volume"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full Name" name="full_name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Address" name="address" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIC" name="nic" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-solid fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group date" id="dob" data-target-input="nearest">
                <input type="text" id="datetimepicker-input-dob" name="dob" class="form-control datetimepicker-input vadlid-age" data-target="#dob" data-toggle="datetimepicker" placeholder="Date of birth" required>
                <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control laxEmail" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-solid fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control pass" placeholder="Password" id="password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password"  id="password_confirmation" name="password_confirmation" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
            <!-- <label id="terms-error" class="text-danger custom" for="terms">This field is required.</label> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-dark btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <a href="/signin" class="text-center">I already have a membership</a> -->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/assets/theme-default/plugins/jquery/jquery.min.js"></script>
<!-- jQuery Validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/theme-default/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="/assets/theme-default/plugins/moment/moment.min.js"></script>
<script src="/assets/theme-default/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/theme-default/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Toastr js -->
<script src="/assets/theme-default/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/theme-default/dist/js/adminlte.min.js"></script>
<!-- Custom style -->
<script src="/assets/custom/js/form-validation-init.js"></script>

<script>
  $(function () {
     //Date picker
     $('#dob').datetimepicker({
        format: 'Y-MM-DD'
    });
  });
</script>

@if (session('success'))
    <script>
        $( document ).ready(function() {
          toastr.success( "{{ session('success') }}")
        });
    </script>
@endif

@if (session('error'))
    <script>
        $( document ).ready(function() {
          toastr.error( "{{ session('error') }}")
        });
    </script>
@endif
</body>
</html>

