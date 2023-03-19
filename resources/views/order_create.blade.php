

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-7">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <label for="search-item">Search Item</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" id="search-item" name="search-item" required>
                                <?= getUserRolesSelectBox('',true); ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card card-gray">
                            <div class="card-header" style="background-color: #8ca4b9;">
                                <h3 class="card-title">Vendor Name</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <!-- <div class="table-responsive"> -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="display: flex;">
                                                        <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                        <p class="ml-2">janith</p>
                                                    </div>
                                                </td>
                                                <td>1000</td>
                                                <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="display: flex;">
                                                        <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                        <p class="ml-2">janith</p>
                                                    </div>
                                                </td>
                                                <td>1000</td>
                                                <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                                <td>1000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <td>$180</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <!-- </div> -->
                            </div>
                            <div class="card-footer" style="background: #dee2e6;"></div>
                        </div>
                        
                        <div class="card card-gray">
                            <div class="card-header" style="background-color: #8ca4b9;">
                                <h3 class="card-title">Vendor Name</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <!-- <div class="table-responsive"> -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="display: flex;">
                                                        <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                        <p class="ml-2">janith</p>
                                                    </div>
                                                </td>
                                                <td>1000</td>
                                                <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="display: flex;">
                                                        <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                        <p class="ml-2">janith</p>
                                                    </div>
                                                </td>
                                                <td>1000</td>
                                                <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                                <td>1000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <td>$180</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <!-- </div> -->
                            </div>
                            <div class="card-footer" style="background: #dee2e6;"></div>
                        </div>
                            
                    </div> 

                </div>
            </div>


            <div class="col-md-5">

                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <label for="set-customer">Set Customer</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" id="set-customer" name="customer" required>
                                <?= getUserRolesSelectBox('',true); ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                    <br>
                        <input class="form-control" type="text" placeholder="Default input">
                    <br>
                        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>