

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

