    
    
    var base_url = window.location.origin;

    $( document ).ready(function() {

        // Summernote
        $('#short_description').summernote({
            height: 150
        });

        $('#long_description').summernote({
            height: 150
        });

        $("#crop-cancel-btn").hide();
        $("#crop-btn").hide();

        setImageCount();

        // $('#custom-brand').select2({
        //     placeholder: 'search brand',
        //     minimumInputLength: 3,
        //     ajax: {
        //       url: base_url+'/autocomplete',
        //       dataType: 'json',
        //       delay: 250,
        //       processResults: function (data) {
        //         return {
        //           results:  $.map(data, function (item) {
        //                 return {
        //                     text: item.title,
        //                     id: item.id
        //                 }
        //             })
        //         };
        //       },
        //       cache: true
        //     }
        //   });
    });


    /*
    |--------------------------------------------------------------------------
    |function set slug
    |--------------------------------------------------------------------------
    */
    function setSulg(ele) {

        let value = $(ele).val().toLowerCase();
        value = value.replace(/[^a-zA-Z0-9]+/g, '-');
        $('#slug').val(value);
    }
    
    
    /*
    |--------------------------------------------------------------------------
    |Image cropper function
    |--------------------------------------------------------------------------
    */
    var  $model = $('#cropper-modal');
    var  $image = document.getElementById('canvas-image');
    var  cropper;
    var  num = 0;
    var  file_name = '';


    $(document).on('change', '#img_file', function(e) {

        if(cropper){
            $image.src = '';
            cropper.destroy(),
            cropper = null;
        }

        var files = e.target.files;

        var done = function(url){
            $image.src = url;
            if($('#canvas-image').show()){cropperInitialize();}
        }

        var reader;
        var file;
        var url;

      if(files && files.length>0){
          file = files[0];
          file_name = file.name;
          if(URL){
            done(URL.createObjectURL(file));
          }else if(FileReader){
            reader =  new FileReade();
            reder.onload = function(e){
              done(reader.result);
            }
            reader.readAsDataURL(file);
          }
          $("#crop-cancel-btn").show();
          $("#crop-btn").show();
      }

    });

    function cropperInitialize(){
        cropper = new Cropper($image,{
            dragMode: 'move',
            aspectRatio:1,
            autoCropArea: 1,
            restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
         });
    }

    function clearlCrop(){
        if(cropper){
            $image.src = '';
            cropper.destroy(),
            cropper = null;
        }
        file_name = '';
        $("#img_file" ).val(null);
        $('#canvas-image').hide();
        $("#crop-cancel-btn").hide();
        $("#crop-btn").hide();
    }

    function imageCrop(){

        if($("#img_file").val()){

            if($('.custom.card-body').length < 1){

            canvas = cropper.getCroppedCanvas({
                width:350,
                height:350,
                });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onload = function(e){
                    var base64data = reader.result;
                    
                    $('#result-row').append('<div class="col-lg-3 product-image-cropped" id="product-image-cropped-'+num+'">\
                    <div class="card card-widget product-card">\
                      <div>\
                        <button type="button" class="btn btn-danger btn-sm float-right" style="width: 15%;" onclick="removeImage('+num+')"><i class="fa fa-times" aria-hidden="true"></i></button>\
                      </div>\
                      <div class="custom card-body">\
                        <div class="img-parent">\
                            <div class="imag-wrapper">\
                              <img class="img-fluid pad" src="'+base64data+'" alt="">\
                            </div>\
                        </div>\
                      </div>\
                    </div>\
                    <input type="hidden" name="product_image" value="'+base64data+'">\
                    <input type="hidden" name="image_name" value="'+file_name+'">\
                    </div>');
                    num++;
                    clearlCrop();
                    setImageCount();
                }

            });

            }
            else{
                toastr.error( "only 1 image can added");
                clearlCrop();
            }
        }
        else{
            toastr.error( "image requierd");
        }

    };


    function removeImage(index){
        $('#product-image-cropped-'+index).remove();
        setImageCount();
    }


    function setImageCount(){
        var length = $('.product-image-cropped').length;
        if(length == 0){
            $('#image_count').val('');
        }
        else{
            $('#image_count').val(length);
        }
    }








  