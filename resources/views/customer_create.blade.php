
<!-- form start -->
<form action="/customer-create-submit" method="POST" id="customer-create-form">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nic">NIC</label>
                            <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dob">Date of birth</label>
                            <div class="input-group date" id="dob" data-target-input="nearest">
                                <input type="text" id="datetimepicker-input-dob" name="dob" class="form-control datetimepicker-input vadlid-age" data-target="#dob" data-toggle="datetimepicker" placeholder="Enter Dob " required>
                                <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control phone" id="phone" name="phone" placeholder="Enter Phone" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control laxEmail" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control pass" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" required>
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



