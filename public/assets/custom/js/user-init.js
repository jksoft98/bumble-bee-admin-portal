

function setUserRole(ele){
    var value = $(ele).val();
    if(value == 2){
        $('.basic-info').prepend('<div class="col-md-12" id="business-name-col">\
                                    <div class="form-group">\
                                        <label for="first_name">Business Name</label>\
                                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter Business Name" value="" required>\
                                    </div>\
                                 </div>');
    }
    else{
        $('#business-name-col').remove();
    }
}