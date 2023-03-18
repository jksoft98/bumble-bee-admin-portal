

/*
|--------------------------------------------------------------------------
|function dataTable
|--------------------------------------------------------------------------
*/
$(function () {
    $('#product-list').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      "columnDefs": [
        { targets: -1, orderable: false },
        { targets: 1, orderable: false }
      ],
      "order": [[0, 'desc']],
    }).buttons().container().appendTo('#product-list_wrapper .col-md-6:eq(0)');

    $('.dt-buttons').find('button').addClass('btn-sm');
});



function showImageModal(key){
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg-"+key);
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
   
}

function hideImageModal(){
    // Get the modal
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}


$(".btn.btn-sm.bg-olive").find('input').click(function() {
  console.log($(this).val());
  var parameter = $(this).val();
  var base_url  = window.location.origin;
  var url       = base_url+'/product-list/'+parameter;
  if(parameter==''){
    url = base_url+'/product-list';
  }
  location.replace(url);
});



/*
|--------------------------------------------------------------------------
|function product status modal show
|--------------------------------------------------------------------------
*/
function productStatusModal(ele,status){
  var id          = JSON.parse(ele.closest('.btn-group').getAttribute('data-id'));
  var title       = JSON.parse(ele.closest('.btn-group').getAttribute('data-title'));
  var titleClass  ='';
  var modal       = $('#productStatusModal');
  if(status == 'approved'){
    titleClass = '<small class="badge bg-lime">Approved</small>';
  }
  if(status == 'pending'){
    titleClass = '<small class="badge badge-info">Pending</small>';
  }
  if(status == 'disapproved'){
    titleClass = '<small class="badge badge-danger">Disapproved</small>';
  }
  $('#product-id').remove();
  $('#product-status').remove();
  modal.find('.modal-title').html('('+title+') status to <small class="badge badge-light"><i class="fas fa-angle-right"></i></small> '+titleClass);
  modal.find('.modal-body').append('<input type="hidden" id="product-id" name="product_id" value="'+id+'">\
                                    <input type="hidden" id="product-status" name="status" value="'+status+'">');
  modal.modal('show');
}

