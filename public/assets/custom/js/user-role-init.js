/*
|--------------------------------------------------------------------------
|  Document ready
|--------------------------------------------------------------------------
*/
$( document ).ready(function() {
    checkAllChecked();
});


/*
|--------------------------------------------------------------------------
|checkbox on-change
|--------------------------------------------------------------------------
*/
$(".cheack-all :input[type=checkbox]" ).change(function() {
    checkAllChecked();
});


/*
|--------------------------------------------------------------------------
|function selectAll checkbox
|--------------------------------------------------------------------------
*/
function selectAll(ele) {
    if($(ele).is(':checked')) {
      $(ele).closest("tr").find(".cheack-all :input[type=checkbox]").prop('checked',true);
    } else {
      $(ele).closest("tr").find(".cheack-all :input[type=checkbox]").prop('checked',false);
    }
}


/*
|--------------------------------------------------------------------------
|function check all checkbox
|--------------------------------------------------------------------------
*/
function checkAllChecked(){

    $("#user-role tbody tr").each(function () {
        var allchecked = true;
        $(this).find(".cheack-all :input[type=checkbox]").each(function () {
            if(!$(this).is(':checked')){
                allchecked = false;
            }
        });
        $(this).find(".select-all").prop('checked',false)
        if(allchecked == true){
            $(this).find(".select-all").prop('checked',true)
        }
    });
}


/*
|--------------------------------------------------------------------------
|function dataTable
|--------------------------------------------------------------------------
*/
$(function () {
    if($('#example2').length > 0){
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "columnDefs": [
            { targets: 4, orderable: false }
        ],
        "order": [[0, 'desc']],
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    }
});
