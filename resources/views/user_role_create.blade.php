
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
        <div class="col-md-12">
                <!-- general form elements -->
            <div class="card card-dark card-outline">
             <div class="card-header">
                    <h3 class="card-title">Basic Info </h3>
            </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method='post' action="{{url('/user-role-create-submit')}}" id="user-role-create-form">
                     @csrf
                    <div class="card-body">          
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-label">Role Name*</label>
                                    <input class="form-control" type="text" name="role_name" value="" id="example-text-input" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-label">Description</label>
                                    <input class="form-control" type="text" name="description" value="" id="example-text-input" placeholder="Enter Description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Form section   -->
                <!-- start table section -->
            <div>
                <div class="card card-light card-outline">
                    <div class="card-header">
                        <h3 class="card-title">User Permissions </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0" id="user-role">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Modules</th>
                                        <th>Select All</th>
                                        <th>Specific Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $key=0; ?>
                                    <?php $sub_key = 0; ?>
                                    <tr>
                                        <th scope="row">{{$key+=1}}</th>
                                        <td><small class="badge badge-info" style="font-size:100%">Dashboard</small></td>
                                        <td>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" class="select-all"  id="todoCheck-set-all-{{$key}}" onclick="selectAll(this)" value="">
                                                <label for="todoCheck-set-all-{{$key}}">Select All</label>
                                            </div>
                                        </td>
                                        <td class="cheack-all">
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="dashboard-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">View</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="allowed-notifications">
                                                <label for="todoCheck-{{$key.$sub_key}}">Allowed Notifications</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$key+=1}}</th>
                                        <td><small class="badge badge-info" style="font-size:100%">Users</small></td>
                                        <td>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" class="select-all" id="todoCheck-set-all-{{$key}}" onclick="selectAll(this)" value="">
                                                <label for="todoCheck-set-all-{{$key}}">Select All</label>
                                            </div>
                                        </td>
                                        <td class="cheack-all">
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User List</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-role-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User Role Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-role-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User Role Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="user-role-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">User Role List</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$key+=1}}</th>
                                        <td><span class="badge badge-info" style="font-size:100%">Customers</span></td>
                                        <td>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" class="select-all" id="todoCheck-set-all-{{$key}}" onclick="selectAll(this)" value="">
                                                <label for="todoCheck-set-all-{{$key}}">Select All</label>
                                            </div>
                                        </td>
                                        <td class="cheack-all">
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="customer-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Customer Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="customer-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Customer Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="customer-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Customer List</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$key+=1}}</th>
                                        <td><span class="badge badge-info" style="font-size:100%">Products</span></td>
                                        <td>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" class="select-all" id="todoCheck-set-all-{{$key}}" onclick="selectAll(this)" value="">
                                                <label for="todoCheck-set-all-{{$key}}">Select All</label>
                                            </div>
                                        </td>
                                        <td class="cheack-all">
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="product-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Product Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="product-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Product Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="product-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Product List</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="brand-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Brand Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="brand-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Brand Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="brand-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Brand List</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="category-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Category Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="category-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Category Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="category-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Category List</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$key+=1}}</th>
                                        <td><span class="badge badge-info" style="font-size:100%">Orders</span></td>
                                        <td>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" class="select-all" id="todoCheck-set-all-{{$key}}" onclick="selectAll(this)" value="">
                                                <label for="todoCheck-set-all-{{$key}}">Select All</label>
                                            </div>
                                        </td>
                                        <td class="cheack-all">
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="order-create-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Order Create</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="order-edit-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Order Edit</label>
                                            </div>
                                            <br>
                                            <div class="icheck-success d-inline ml-2">
                                                <input type="checkbox" name="permission[]" id="todoCheck-{{$key.$sub_key+=1}}" value="order-list-view">
                                                <label for="todoCheck-{{$key.$sub_key}}">Order List</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card-footer mb-3">
                    <button type="submit" class="btn btn-dark float-right">Create</button>
                </div>
            </div>
            <div>
            <!-- end table section -->
            </form>
    <!-- end card body -->
        </div>                         
    </div>          
</div>       
</div><!-- /.container-fluid -->
</section>



