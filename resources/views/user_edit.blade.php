
<!-- form start -->
<form action="/user-edit-submit" method="POST" id="user-create-form">
@csrf 
    <div class="row">

        <!-- left column -->
        <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Basic Info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row basic-info">
                    @if($user->user_role == 2)
                    <div class="col-md-12" id="business-name-col">
                        <div class="form-group">
                            <label for="business_name">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name" value="{{$user->business_name}}" required>
                        </div>
                    </div>
                    @endif
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{$user->first_name}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{$user->last_name}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control phone" id="phone" name="phone" placeholder="Enter Phone" value="{{$user->phone}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="userRole">User Role</label>
                            <select class="form-control select2" style="width: 100%;" id="userRole" name="user_role" required onchange="setUserRole(this)">
                                <?= getUserRolesSelectBox($user->user_role,true); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        
        </div>
        <!-- /.card -->
        </div>
        <!--/.col  -->

        <!-- right column -->
        <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Authentication Info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" id="disablediv">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control laxEmail" id="email" name="email" placeholder="Enter Email" value="{{$user->email}}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control pass" id="password" name="password" placeholder="Enter Password" disabled required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" disabled required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="reset_password" id="disablecheckbox">
                            <label class="form-check-label" for="ticketIssued">Reset Password</label>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card-footer">
                <button type="submit" class="btn btn-dark float-right">Submit</button>
        </div>
        <!-- /.card -->
        </div>
        <!--/.col  -->

        <!-- center column -->
        <div class="col-md-12">
       
        </div>

    </div>
    <!-- /.row -->

</form>

<script>
   
</script>



