

<section class="content">
    <!-- form start -->
    <form action="/order-create-submit" method="POST" id="user-create-form">
    @csrf 
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-7">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <label for="search-item">Search Item</label>
                        <div class="form-group">
                            <select class="form-control js-example-data-ajax" style="width: 100%;" id="search-item" name="search-item">
                            </select>
                        </div>
                    </div>
                    <div class="card-body result-parent">

                        <!-- <div class="card card-gray vendor-card">
                            <div class="card-header" style="background-color: #8ca4b9;">
                                <h3 class="card-title">Vendor Name</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                    <p class="ml-2">janithjanithjanithjanith</p>
                                                </div>
                                            </td>
                                            <td>1000</td>
                                            <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control form-control-sm" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                            <td>1000</td>
                                            <td><button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                    <img src="http://127.0.0.1:8000/product-image/fa4a5b57b47068573c61fa15d51fdd8f.webp" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">
                                                    <p class="ml-2">janith</p>
                                                </div>
                                            </td>
                                            <td>1000</td>
                                            <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control form-control-sm" name="price" id="price" placeholder="Set Qty" value="" required></td>
                                            <td>1000</td>
                                            <td><button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">Total Amount</th>
                                            <td colspan="2">$180</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-footer" style="background: #dee2e6;"></div>
                        </div> -->
                        
                            
                    </div> 

                </div>
            </div>


            <div class="col-md-5">

                <div class="card card-dark card-outline set-customer-card">
                    <div class="card-header">
                        <label for="set-customer">Set Customer</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" id="set-customer" name="customer" required>
                                <?= getCustomerSelectBox('',true); ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"> 
                                <label for="full_name">Full Name</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <label for="full_name">NIC</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <label for="full_name">Phone</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <label for="full_name">Email</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <label for="full_name">Address</label>
                                <div class="form-group">
                                    <textarea class="form-control form-control-sm" readonly></textarea>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                </div>

                <div class="card card-dark card-outline total-summary">
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal</th>
                                    <td>$250.30</td>
                                </tr>
                                <tr>
                                    <th>Grand Total</th>
                                    <td>$265.24</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-dark float-right">Submit</button>
                </div>

                </div>
                

            </div>

        </div>
    </div>
    </form>
</section>

<script>
    var api_url = '<?= config('site-specific.api_url'); ?>';
</script>