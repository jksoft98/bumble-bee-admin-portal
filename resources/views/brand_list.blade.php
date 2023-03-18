<div class="row">
  <div class="col-12">
    <div class="card">
    <div class="card-header">
        @if(in_array('brand-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
        <div class="row">
            <div class="col-md-12">
                <button type="button" onclick="brandCreate()" class="btn btn-dark float-right">Add New</button>
            </div>
        </div>
        @endif
      </div>
      <div class="card-body">
        <table id="brand-list" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Brand Name</th>
            <th>Discription</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach($brands as $data)
              <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->brand_name}}</td>
                <td>{{$data->description}}</td>
                <td><?php echo ($data->status)? '<button type="button" class="btn btn-md" data-brandid="'.$data->id.'" onclick="requestChangeBrandStatus(this,0)"><small class="badge badge-success">Active</small></button>':'<button type="button" class="btn btn-md" data-brandid="'.$data->id.'" onclick="requestChangeBrandStatus(this,1)"><small class="badge badge-danger">Inactive</small></button>';  ?> </td>
                <td>
                  <div class="btn-group" data-parent='{{json_encode($data)}}'>
                    <button type="button" class="btn btn-dark btn-sm">Action</button>
                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      @if(in_array('brand-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                      <a type="button" class="dropdown-item text-info" onclick="brandEdit(this)"><i class="fas fa-edit"></i> Edit</a>
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

@if(in_array('brand-create-view', session()->get('user_permissions')) || in_array('brand-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
 <!-- brand modal -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="brandModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brandModalLabel">Create Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/brand-create-submit" method="POST" id="brand-form">
        @csrf 
        <div class="modal-body">
            <div class="form-group">
              <label for="brand_name" class="col-form-label">Brand name:</label>
              <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
              <label for="description" class="col-form-label">Description:</label>
              <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter Description"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /brand modal -->
@endif