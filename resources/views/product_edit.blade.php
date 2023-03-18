<style>
    .img-container.cropper-custom > img {
      display: block;
      /* This rule is very important, please don't ignore this */
      max-width: 100%;
      max-height: 200px;
    }

/*
|--------------------------------------------------------------------------
| Image ratio.
|--------------------------------------------------------------------------
|
*/
.img-parent {
  width: 100%;
}

.imag-wrapper {
  display: block;
  width: 100%;
  height: auto;
  position: relative;
  overflow: hidden;
  padding: 80.37% 0 0 0;
  /* 34.37% = 100 / (w / h) = 100 / (640 / 220) */
}

.imag-wrapper img {
  display: block;
  max-width: 100%;
  max-height: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: 0 auto;
}
    
</style>

<form action="/product-edit-submit" method="POST" id="product-form">
@csrf
<div class="card card-dark card-outline">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="nav flex-column nav-tabs h-100 add-listing-tab" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
            @if(session()->get('user_role') != 2)
            <a class="nav-link active" id="vert-tabs-vendor-tab" data-toggle="pill" href="#vert-tabs-vendor" role="tab" aria-controls="vert-tabs-vendor" aria-selected="false"><i class="fas fa-user-alt"></i> Vendor</a>
            @endif
            <a class="nav-link  @if(session()->get('user_role') == 2) active  @endif" id="vert-tabs-basic-tab" data-toggle="pill" href="#vert-tabs-basic" role="tab" aria-controls="vert-tabs-basic" aria-selected="true"><i class="fas fa-file-alt"></i> Basic Info </a> <!--<span id="error-icon"><i class="fas fa-exclamation-triangle" style="color: #b90707;"></i></span>-->
            <a class="nav-link" id="vert-tabs-stock-tab" data-toggle="pill" href="#vert-tabs-stock" role="tab" aria-controls="vert-tabs-stock" aria-selected="false"><i class="fas fa-store-alt"></i> Pricing </a>
            <a class="nav-link" id="vert-tabs-description-tab" data-toggle="pill" href="#vert-tabs-description" role="tab" aria-controls="vert-tabs-description" aria-selected="false"><i class="fas fa-align-justify"></i> Product Description </a>
            <a class="nav-link" id="vert-tabs-image-tab" data-toggle="pill" href="#vert-tabs-image" role="tab" aria-controls="vert-tabs-image" aria-selected="false"><i class="fas fa-images"></i> Product Images </a>
            <a class="nav-link" id="vert-tabs-seo-tab" data-toggle="pill" href="#vert-tabs-seo" role="tab" aria-controls="vert-tabs-seo" aria-selected="false"><i class="fas fa-laptop"></i> SEO </a>
          </div>
        </div>
        <div class="col-12 col-md-9">
          <div class="tab-content add-listing-tab-content" id="vert-tabs-tabContent">

            @if(session()->get('user_role') != 2)
            <div class="tab-pane fade show active mt-2" id="vert-tabs-vendor" role="tabpanel" aria-labelledby="vert-tabs-vendor-tab">
              <h4>Vendor Info</h4>
                <div class="form-group">
                    <label for="vendor" class="col-sm-2">Set Vendor</label>
                    <select class="form-control select2" name="vendor" id="vendor" style="width: 100%;" required>
                      <?= getVendorSelectBox($product->vendor,true); ?>
                    </select>
                </div>
            </div>
            @endif

            <div class="tab-pane text-left fade @if(session()->get('user_role') == 2) show active @endif mt-2" id="vert-tabs-basic" role="tabpanel" aria-labelledby="vert-tabs-basic-tab">
              <h4>Basic Info</h4>
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" class="form-control" onkeyup="setSulg(this)" name="title" id="title" placeholder="Enter Product Title" autofocus value="{{$product->title}}" required>
                </div>
                <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" name="sku" id="sku" placeholder="Enter SKU" value="{{$product->sku}}" required>
                {{-- <label class="text-danger">SKU already exists.</label> --}}
                </div>
                <div class="form-group">
                    <label for="brand" class="col-sm-2">Brand</label>
                    <select class="form-control select2" name="brand" id="brand" style="width: 100%;" required>
                      <?= getBrandSelectBox($product->brand,true); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category" class="col-sm-2">Category</label>
                    <select class="form-control select2" name="category" id="category" style="width: 100%;" required>
                      <?= getCategorySelectBox($product->category,true); ?>
                    </select>
                </div>
            </div>

            <div class="tab-pane fade mt-2" id="vert-tabs-stock" role="tabpanel" aria-labelledby="vert-tabs-stock-tab">
              <h4>Pricing</h4>
                <div class="form-group">
                    <label for="price">Price(Rs.)</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter Selling Price" value="{{$product->price}}" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight(g)</label>
                    <input type="number" class="form-control" name="weight" id="weight" placeholder="Enter Weight in grams" value="{{$product->weight}}" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Enter Stock" value="{{$product->stock}}" required>
                </div>
            </div>

            <div class="tab-pane fade mt-2" id="vert-tabs-description" role="tabpanel" aria-labelledby="vert-tabs-description-tab">
              <h4>Product Description</h4>
                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea id="short_description" id="short_description" name="short_description" rows="3" cols="80" required>{{$product->short_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="long_description">Long Description</label>
                    <textarea id="long_description" name="long_description" rows="3" cols="80" required>{{$product->long_description}}</textarea>
                </div>
            </div>

            <div class="tab-pane fade mt-2" id="vert-tabs-image" role="tabpanel" aria-labelledby="vert-tabs-image-tab">
              <h4>Product Images</h4>
              <div class="form-group">
                    <label for="file">Add Image</label><span class="ml-1"></span>
                     <input type="file" class="form-control" name="file" id="img_file" style="padding-bottom: 36px;">
                     <input type="hidden" name="image_count" id="image_count" required>
              </div>

              <!-- <div class="container"> -->
                <div class="row mb-2">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="img-container cropper-custom">
                      <img id="canvas-image" src="">
                    </div>
                    <button type="button" class="btn btn-danger mt-2" id="crop-cancel-btn" onclick="clearlCrop()">cancel</button>
                    <button type="button" class="btn btn-success mt-2" id="crop-btn" onclick="imageCrop()">Crop</button>
                  </div>
                </div>
                <div class="row mt-3" id="result-row">
                  
                  <div class="col-lg-12">
                      <hr>
                  </div>
                  <!-- <div class="col-lg-3">

                  </div>
                  <div class="col-lg-3">

                  </div> -->
                  @if($product->cover_image != null)
                    <div class="col-lg-3 product-image-cropped" id="product-image-cropped-0">
                      <div class="card card-widget product-card">
                        <div>
                          <button type="button" class="btn btn-danger btn-sm float-right" style="width: 15%;" onclick="removeImage(0)"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="custom card-body">
                          <div class="img-parent">
                              <div class="imag-wrapper">
                                <img class="img-fluid pad" <?php  $img = route('display-product-image',$product->cover_image); echo " src='$img'" ;?> alt="product-image">
                              </div>
                          </div>
                        </div>
                      </div>       
                    </div>
                  @endif
                </div>
                @if($product->cover_image != null)
                <input type="hidden" name="exists_image" id="exists_image" value="{{$product->cover_image}}">
                @endif
              <!-- </div> -->
            </div>

            <div class="tab-pane fade mt-2" id="vert-tabs-seo" role="tabpanel" aria-labelledby="vert-tabs-seo-tab">
              <h4>SEO</h4>
                <div class="form-group">
                    <label for="brand">Slug</label>
                    <input type="text" class="form-control slug" name="slug" id="slug" placeholder="Enter Product Slug" value="{{$product->slug}}" required>
                  </div>
                  <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Product Meta Title" value="{{$product->meta_title}}">
                  </div>
                  <div class="form-group">
                      <label for="meta_description">Meta Description</label>
                      <input type="text" class="form-control" name="meta_description" id="meta_description"placeholder="Enter Product Meta Description" value="{{$product->meta_description}}">
                  </div>
            </div>
          </div>
        </div>
      </div>
 
    </div>
    <!-- /.card -->
  </div>
  <!-- /.card -->

  <div class="card-footer mb-3">
    <button type="submit" class="btn btn-dark float-right">Update</button>
  </div>
</form>              
