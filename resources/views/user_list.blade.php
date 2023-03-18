<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>User Role</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->last_name}}</td>
                        <td>{{$data->phone}}</td>
                        <td> {{$data->user_role->role_name}}</td>
                        <td>{{$data->email}}</td>
                          <td><?php echo ($data->status)? '<button type="button" class="btn btn-md" data-userid="'.$data->id.'" data-roleid="'.$data->user_role->id.'" onclick="requestChangeUserStatus(this,0)"><small class="badge badge-success">Active</small></button>':'<button type="button" class="btn btn-md" data-userid="'.$data->id.'" data-roleid="'.$data->user_role->id.'" onclick="requestChangeUserStatus(this,1)"><small class="badge badge-danger">Inactive</small></button>';  ?> </td> 
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm">Action</button>
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              @if(in_array('user-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                                <a class="dropdown-item text-info" href="/user-edit/{{$data->id}}"><i class="fas fa-edit"></i> Edit</a>
                              @else
                                <a type="button" class="dropdown-item text-secondary">No Action</a>
                              @endif  
                              <!-- <a class="dropdown-item text-danger" href="#"><i class="fas fa-trash"></i> Delete</a> -->
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
