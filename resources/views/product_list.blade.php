<style>
/* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal-custom {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content-custom {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content-custom, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close-custom {
  position: absolute;
  top: 60px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close-custom:hover,
.close-custom:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content-custom {
    width: 100%;
  }
}
</style>

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-sm bg-olive @if($selected_status == null) active @endif">
                    <input type="radio" value="" name="options" id="option_b1" autocomplete="off" @if($selected_status == null) checked="" @endif> All <span class="badge bg-light">{{$counts->all}}</span>
                  </label>
                  <label class="btn btn-sm bg-olive @if($selected_status == 'pending') active @endif">
                    <input type="radio" value="pending" name="options" id="option_b2" autocomplete="off" @if($selected_status == 'pending') checked="" @endif> Pending <span class="badge bg-light">{{$counts->pending}}</span>
                  </label>
                  <label class="btn btn-sm bg-olive @if($selected_status == 'approved') active @endif">
                    <input type="radio" value="approved" name="options" id="option_b3" autocomplete="off" @if($selected_status == 'approved') checked="" @endif> Approved <span class="badge bg-light">{{$counts->approved}}</span>
                  </label>
                  <label class="btn btn-sm bg-olive @if($selected_status == 'disapproved') active @endif">
                    <input type="radio" value="disapproved" name="options" id="option_b4" autocomplete="off" @if($selected_status == 'disapproved') checked="" @endif> Disapproved <span class="badge bg-light">{{$counts->disapproved}}</span>
                  </label>
                </div>
              </div>
              <div class="card-body">
                <table id="product-list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>SKU</th>
                    <th>Stock</th>
                    <th>Weight(g)</th>
                    <th>Price(LKR)</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Status</th>
                    @if(session()->get('user_role') != 2)
                    <th>Vendor</th>
                    @endif
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $key => $data)
                    <tr>
                      <td>{{$data->id}}</td>
                      <td><img onclick="showImageModal({{$key}})" id="myImg-{{$key}}" <?php  $img = route('display-product-image',$data->cover_image); echo " src='$img'" ;?> alt="{{$data->slug}}" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;"></td>
                      <td>{{$data->title}}</td>
                      <td>{{$data->sku}}</td>
                      <td>{{$data->stock}}</td>
                      <td>{{$data->weight}}</td>
                      <td>{{number_format($data->price,2)}}</td>
                      <td>{{$data->brand->brand_name}}</td>
                      <td>{{$data->category->category_name}}</td>
                      <td>@if($data->status=='approved')<small class="badge bg-lime">Approved</small>@endif @if($data->status=='pending')<small class="badge badge-info">Pending</small>@endif @if($data->status=='disapproved')<small class="badge badge-danger">Disapproved</small>@endif</td>
                      @if(session()->get('user_role') != 2)
                      <td>{{$data->vendor->business_name}}</td>
                      @endif
                      <td>
                        <div class="btn-group" data-id='{{json_encode($data->id)}}' data-title='{{json_encode($data->title)}}'>
                          <button type="button" class="btn btn-dark btn-sm">Action</button>
                          <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            @if(in_array('product-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                              <a class="dropdown-item text-dark" target="_blank" href="/product-edit/{{$data->id}}"><i class="fas fa-edit"></i> Edit</a>
                              @if($data->status!='pending' && session()->get('user_role') != 2)
                                <a onclick="productStatusModal(this,'pending')" type="button" class="dropdown-item text-info" ><i class="fas fa-redo"></i> Pending</a>
                              @endif
                              @if($data->status!='approved' && session()->get('user_role') != 2)
                                <a onclick="productStatusModal(this,'approved')" type="button" class="dropdown-item text-success" ><i class="fas fa-check"></i> Approve</a>
                              @endif
                              @if($data->status!='disapproved' && session()->get('user_role') != 2)
                                <a onclick="productStatusModal(this,'disapproved')" type="button" class="dropdown-item text-danger" ><i class="fas fa-minus-circle"></i> Disapprove</a>
                              @endif
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

        <!-- The Modal -->
        <div id="myModal" class="modal-custom">
          <!-- The Close Button -->
          <span class="close-custom" onclick="hideImageModal()">&times;</span>
          <!-- Modal Content (The Image) -->
          <img class="modal-content-custom" id="img01">
          <!-- Modal Caption (Image Text) -->
          <div id="caption"></div>
        </div>
        <!--/ The Modal -->


        @if(in_array('product-edit-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
        <!-- Product modal -->
        <div class="modal fade" id="productStatusModal" tabindex="-1" role="dialog" aria-labelledby="productStatusModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productStatusModalLabel">Create product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/change-product-status-submit" method="POST" id="change-product-status-form">
                @csrf 
                <div class="modal-body text-center">
                    <h5>Are You Sure?</h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-dark">Yes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /Product modal -->
        @endif