
  /*
  |--------------------------------------------------------------------------
  |  Document ready
  |--------------------------------------------------------------------------
  */
  
  $(document).ready(function() {

    //select2
    $('.select2').select2();

    //Date picker
    $('#dob').datetimepicker({
      format: 'Y-MM-DD'
    });
    
    var pusher = new Pusher('40d75bd8f0e0c4dcf690', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-tool', function(data) {
        if(data.to.length > 0) {
          $.each(data.to, function( index, value ) {
            if(value == userRoleId){
              getNotificationAjaxRequest();
              failed_sound.play();
            }
          });
        }
    });

    getNotificationAjaxRequest();

  });

  $('#disablecheckbox').change(function(){
    $('#disablediv').find(':input[type=password]').prop('disabled',!this.checked);
  });


  function requestChangeUserStatus(ele,status){
    var role_id = $(ele).attr('data-roleid');
    if(role_id == 1){
      toastr.error('Can`t change the user status!  User role was super admin');
      failed_sound.play();
    }else{
      invokeLoader();
      var type    = 'user';
      var user_id = $(ele).attr('data-userid');
      const data  = {user_id:user_id, status:status, _token:token};
      sendPostAjaxRequest(ele,'/change-user-status-ajax',data,type);
    }
  }

  function requestChangeCustomerStatus(ele,status){
    invokeLoader();
    var type        = 'customer';
    var customer_id = $(ele).attr('data-customerid');
    const data      = {customer_id:customer_id, status:status, _token:token};
    sendPostAjaxRequest(ele,'/change-customer-status-ajax',data,type);
  }

  function requestChangeRoleStatus(ele,status){
    invokeLoader();
    var type        = 'role';
    var role_id     = $(ele).attr('data-roleid');
    const data      = {role_id:role_id, status:status, _token:token};
    sendPostAjaxRequest(ele,'/change-role-status-ajax',data,type);
  }

  function requestChangeBrandStatus(ele,status){
    invokeLoader();
    var type        = 'brand';
    var brand_id    = $(ele).attr('data-brandid');
    const data      = {brand_id:brand_id, status:status, _token:token};
    sendPostAjaxRequest(ele,'/change-brand-status-ajax',data,type);
  }

  function requestChangeCategoryStatus(ele,status){
    invokeLoader();
    var type        = 'category';
    var category_id = $(ele).attr('data-categoryid');
    const data      = {category_id:category_id, status:status, _token:token};
    sendPostAjaxRequest(ele,'/change-category-status-ajax',data,type);
  }

  function sendPostAjaxRequest(ele,url,data,type){
    var base_url    = window.location.origin;
    $.ajax({  
        type: "POST",
        url: base_url+url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name=token]').attr('content')
        },
        data: data,
        cache:false,     
        success: function(response) {

          if(response.success == true){
            if(data.status == 1){
              $(ele).find('.badge').removeClass('badge-danger');
              $(ele).find('.badge').addClass('badge-success').text('Active');
              if(type=='user'){
                $(ele).attr("onclick","requestChangeUserStatus(this,0)");
              }
              if(type=='customer'){
                $(ele).attr("onclick","requestChangeCustomerStatus(this,0)");
              }
              if(type=='role'){
                $(ele).attr("onclick","requestChangeRoleStatus(this,0)");
              }
              if(type=='brand'){
                $(ele).attr("onclick","requestChangeBrandStatus(this,0)");
              }
              if(type=='category'){
                $(ele).attr("onclick","requestChangeCategoryStatus(this,0)");
              }
            }
            else{
              $(ele).find('.badge').removeClass('badge-success');
              $(ele).find('.badge').addClass('badge-danger').text('Inactive');
              if(type=='user'){
                $(ele).attr("onclick","requestChangeUserStatus(this,1)");
              }
              if(type=='customer'){
                $(ele).attr("onclick","requestChangeCustomerStatus(this,1)");
              }
              if(type=='role'){
                $(ele).attr("onclick","requestChangeRoleStatus(this,1)");
              }
              if(type=='brand'){
                $(ele).attr("onclick","requestChangeBrandStatus(this,1)");
              }
              if(type=='category'){
                $(ele).attr("onclick","requestChangeCategoryStatus(this,1)");
              }
            }
            toastr.success("Status Updated Successfully");
            success_sound.play();
          }
          else{
            toastr.error(response.message);
            failed_sound.play();
          }  
          removeLoader();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error( "Oops... Something went to wrong. Please try again!"+ajaxOptions)
        }
    });
  
  }



  function getNotificationAjaxRequest(){
    var base_url    = window.location.origin;
    $.ajax({  
        type: "GET",
        url: base_url+'/get-notifications-ajax',
        headers: {
            'X-CSRF-TOKEN': $('meta[name=token]').attr('content')
        },
        data: {
          _token:token,
        },
        cache:false,     
        success: function(response) {
          if(response.success == true){
            $('#notification-area').find('.pending').html(response.data.count);
            $('#notification-area').find('.dropdown-header').html(response.data.count+' Notifications');
            if(response.data.count == 0){
              $('#notification-area').find('.pending').html('');
              $('#notification-area').find('.dropdown-header').html('No Notifications');
            }
            $('#notification-area').find('.notification-body').html('');
            $.each(response.data.messages, function( index, value ) {
              $('#notification-area').find('.notification-body').append('<div class="dropdown-divider"></div>\
                <a href="javascript:void(0)" class="dropdown-item">\
                <div class="media">\
                  <div class="media-body">\
                    <h3 class="dropdown-item-title">\
                      '+value.username+'\
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>\
                    </h3>\
                    <p class="text-sm">'+value.message+'</p>\
                    <p class="text-sm text-muted text-right"><i class="far fa-clock mr-1"></i>'+value.time+'</p>\
                  </div>\
                </div>\
                </a>'
              ); 
            });
          }
          else{
            $('#notification-area').find('.pending').html('');
            $('#notification-area').find('.dropdown-header').html('No Notifications');
            $('#notification-area').find('.notification-body').html('');
          }  
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error( "Oops... Something went to wrong. Please try again!"+ajaxOptions)
        }
    });
  
  }
