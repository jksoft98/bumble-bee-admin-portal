<div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                @if(in_array('user-role-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ URL::to('/user-role-create') }}" target="_blank" class="btn btn-dark float-right">Add New</a>
                    </div>
                </div>
                @endif
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Discription</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($user_roles as $data)
                      @if($data->id != 1)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->role_name}}</td>
                        <td>{{$data->description}}</td>
                        <td><?php echo ($data->status)? '<button type="button" class="btn btn-md" data-roleid="'.$data->id.'" onclick="requestChangeRoleStatus(this,0)"><small class="badge badge-success">Active</small></button>':'<button type="button" class="btn btn-md" data-roleid="'.$data->id.'" onclick="requestChangeRoleStatus(this,1)"><small class="badge badge-danger">Inactive</small></button>';  ?> </td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm">Action</button>
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              @if(in_array('user-role-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                                <a class="dropdown-item text-info" href="/user-role-edit/{{$data->id}}"><i class="fas fa-edit"></i> Edit</a>
                              @else
                                <a type="button" class="dropdown-item text-secondary">No Action</a>
                              @endif
                              <!-- <a class="dropdown-item text-danger" href="#"><i class="fas fa-trash"></i> Delete</a> -->
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endif
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
