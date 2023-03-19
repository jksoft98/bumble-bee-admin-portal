
  
  var globalArray   = [];
  var productArray  = [];
  var base_url      = window.location.origin;
  
  
  
  /*
  |--------------------------------------------------------------------------
  |  Document ready
  |--------------------------------------------------------------------------
  */
  
  $(document).ready(function() {

        $(".js-example-data-ajax").select2({
            ajax: {
            url: api_url+"get-search-products",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                globalArray = data.data;
        
                return {
                results: data.data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
                };
            },
            cache: true
            },
            placeholder: 'Search for items',
            minimumInputLength: 3,
            templateResult: formatRepo,
            //allowClear: true,
            //templateSelection: formatRepoSelection
        });
        
        function formatRepo (repo) {
            if (repo.loading) {
            return repo.text;
            }
        
            var url = base_url+"/product-image/"+repo.cover_image;
            var $container = $(
            "<div class='select2-result-repository clearfix m-auto' style='border-style: double;border-width: 1px;cursor: pointer;'>" +
                "<div class='select2-result-repository__avatar table-responsive' style='display: flex;'>"+
                    "<img src='"+url+"' width='120' height='120'/>"+
                    "<div class='select2-result-repository__meta pl-2'>" +
                        "<div class='select2-result-repository__title'> <small class='badge badge-success'>vendor</small></div>" +
                        "<div class='select2-result-repository__description'></div>" +
                        "<div class='select2-result-repository__statistics'>" +
                            "<div class='select2-result-repository__forks'></div>" +
                            "<div class='select2-result-repository__stargazers'></div>" +
                            "<div class='select2-result-repository__watchers'></div>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "</div>"
            );
            $container.find(".select2-result-repository__title").prepend(repo.title);
            $container.find(".select2-result-repository__title small").text(repo.vendor.first_name+' '+repo.vendor.last_name);
            $container.find(".select2-result-repository__description").text('SKU: '+repo.sku);
            $container.find(".select2-result-repository__forks").append('Price: '+new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(repo.price).replace(/\D00$/, ''));
            $container.find(".select2-result-repository__stargazers").append('Brand: '+repo.brand.brand_name);
            $container.find(".select2-result-repository__watchers").append('Stock: '+repo.stock);
        
            return $container;
        }
        
        function formatRepoSelection (repo) {
            //return repo.full_name || repo.text;
        }

        $( ".js-example-data-ajax" ).change(function() {
            addItem(globalArray[$(this).val()]);
            $(".js-example-data-ajax").empty();
        });


        $("#set-customer" ).change(function() {
            setCustomerDataToInput();
            if($(this).val()!=''){
                getSingleCustomerDataAjaxRequest($(this).val());
            }
        });

        calculation();

    });  
    
    
    function getSingleCustomerDataAjaxRequest(customerId){
        $.ajax({  
            type: "GET",
            url: base_url+'/get-single-customer-data-ajax',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=token]').attr('content')
            },
            data: {
              _token:token,
              customer_id:customerId
            },
            cache:false,     
            success: function(response) {
              if(response.success == true){
                var data = response.data;
                setCustomerDataToInput(data.full_name,data.nic,data.phone,data.email,data.address);
              }
              else{
                setCustomerDataToInput();
              }  
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toastr.error( "Oops... Something went to wrong. Please try again!"+ajaxOptions)
            }
        });
    }

    function setCustomerDataToInput(full_name='',nic='',phone='',email='',address=''){
       var input    = $('.set-customer-card').find('input');
       var textarea = $('.set-customer-card').find('textarea');
       $(input[0]).val(full_name);
       $(input[1]).val(nic);
       $(input[2]).val(phone);
       $(input[3]).val(email);
       $(textarea[0]).val(address);
    }



    function addItem(product){
        if($('#vendor-card-'+product.vendor.id).length == 0){
            appendParentItems(product);
        }

        if($('#product-tr-'+product.p_id).length == 0){
            productArray.push(product);
            appendChildItems(product);
            calculation();
        }
        else{
            toastr.error('item was already exists');
        }
    }


    function appendParentItems(product){

        $('.result-parent').append('<div class="card card-gray vendor-card" id="vendor-card-'+product.vendor.id+'">\
            <div class="card-header" style="background-color: #8ca4b9;">\
                <h3 class="card-title">'+product.vendor.first_name+' '+product.vendor.last_name+'</h3>\
            </div>\
            <div class="card-body table-responsive">\
                <table class="table">\
                    <thead>\
                        <tr>\
                        <th scope="col">Product</th>\
                        <th scope="col">Price</th>\
                        <th scope="col">Qty</th>\
                        <th scope="col">Amount</th>\
                        </tr>\
                    </thead>\
                    <tbody>\
                    </tbody>\
                    <tfoot>\
                        <tr>\
                            <th colspan="3" class="text-center">Total Amount</th>\
                            <td colspan="2">$180</td>\
                        </tr>\
                    </tfoot>\
                </table>\
            </div>\
            <div class="card-footer" style="background: #dee2e6;"></div>\
        </div>');
    }

    function appendChildItems(product){
        var url = base_url+"/product-image/"+product.cover_image;
        $('#vendor-card-'+product.vendor.id).find('tbody').prepend('<tr id="product-tr-'+product.p_id+'" data-index="'+(productArray.length - 1)+'">\
            <td>\
                <div style="display: flex;">\
                    <img src="'+url+'" alt="" width="75" height="75" style="border-style: double;border-width: 1px;cursor: pointer;">\
                    <p class="ml-2">'+product.title+'</p>\
                </div>\
                <input type="hidden" name="product_id[]" value="'+product.p_id+'">\
            </td>\
            <td>'+new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(product.price).replace(/\D00$/, '')+'</td>\
            <td><input style="min-width: 100px; max-width: 100px;" type="number" class="form-control form-control-sm" name="qty[]" id="qty-'+product.p_id+'" placeholder="Set Qty" value="1" required onchange="calculation()" onkeyup="calculation()" onfocusout="validateQty(this)"></td>\
            <td>'+new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(product.price).replace(/\D00$/, '')+'</td>\
            <td><button onclick="removeItem(this)" type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button></td>\
        </tr>');
    }


    function calculation(){

        var subTotal = 0;
        $($('.vendor-card')).each(function(index, value ) {
            var totalAmout = 0;
            $($(this).find('tbody tr')).each(function(trIndex, trValue ) {
                var qty     = $(this).find('input[type=number]').val();
                if(qty<=0){
                    qty = 1;
                }
                var product = productArray[$(this).attr('data-index')];
                var amount  = product.price * qty;
                $($(this).find('td')[3]).html(new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(amount).replace(/\D00$/, ''));
                totalAmout += amount;
            });
            $($(this).find('tfoot tr td')[0]).html(new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(totalAmout).replace(/\D00$/, ''));
            subTotal += totalAmout;
        });
        $($('.total-summary').find('tbody tr td')[0]).html(new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(subTotal).replace(/\D00$/, ''));
        $($('.total-summary').find('tbody tr td')[1]).html(new Intl.NumberFormat('en-US', { style: 'currency', currency: 'LKR' }).format(subTotal).replace(/\D00$/, ''));

    }

    function validateQty(ele){
        var product = productArray[$(ele).closest("tr").attr('data-index')];
        if(product.stock < $(ele).val()){
            $(ele).val(product.stock);
        }
        calculation();
    }

    
    function removeItem(ele){
        var cardId = $(ele).closest(".vendor-card").attr('id');
        $(ele).closest("tr").remove();
        if($("#"+cardId).find('tbody tr').length == 0){
            $("#"+cardId).remove();
        }
        calculation();
    }

    