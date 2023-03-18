<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Customer ID</th>
                    <th>Full Name</th>
                    <th>Date Of Birth</th>
                    <th>Phone</th>
                    <th>NIC</th>
                    <th>Email</th>
                    <th>Loan Balance</th>
                    <th>Used Amount</th>
                    <th>Installment Plan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($customers as $data)
                    <tr>
                      <td>{{$data->id}}</td>
                      <td>{{$data->full_name}}</td>
                      <td>{{$data->dob}}</td>
                      <td>{{$data->phone}}</td>
                      <td>{{$data->nic}}</td>
                      <td>{{$data->email}}</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td><?php echo ($data->status)? '<button type="button" class="btn btn-md" data-customerid="'.$data->id.'" onclick="requestChangeCustomerStatus(this,0)"><small class="badge badge-success">Active</small></button>':'<button type="button" class="btn btn-md" data-customerid="'.$data->id.'" onclick="requestChangeCustomerStatus(this,1)"><small class="badge badge-danger">Inactive</small></button>';  ?> </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-dark btn-sm">Action</button>
                          <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            @if(in_array('customer-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                              <a class="dropdown-item text-info" href="/customer-edit/{{$data->id}}"><i class="fas fa-edit"></i> Edit</a>
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
