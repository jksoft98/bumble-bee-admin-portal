
/*
|--------------------------------------------------------------------------
|function dataTable
|--------------------------------------------------------------------------
*/
$(function () {
    $('#category-list').DataTable({
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
    }).buttons().container().appendTo('#category-list_wrapper .col-md-6:eq(0)');
});


/*
|--------------------------------------------------------------------------
|function category create modal show
|--------------------------------------------------------------------------
*/
function categoryCreate(){
  var modal = $('#categoryModal');
  $('#category-id').remove();
  modal.find('.modal-title').html('Create Category');
  modal.find('form').attr('action', '/category-create-submit');
  modal.find('#category_name').val('');
  modal.find('#description').val('');
  modal.find('button[type=submit]').html('Create');
  modal.modal('show');
}


/*
|--------------------------------------------------------------------------
|function category edit modal show
|--------------------------------------------------------------------------
*/
function categoryEdit(ele){
  var data = JSON.parse(ele.closest('.btn-group').getAttribute('data-parent'));
  var modal = $('#categoryModal');
  $('#category-id').remove();
  modal.find('.modal-title').html('Edit Category');
  modal.find('form').attr('action', '/category-edit-submit');
  modal.find('#category_name').val(data.category_name);
  modal.find('#description').val(data.description);
  modal.find('.modal-body').append('<input type="hidden" id="category-id" name="category_id" value="'+data.id+'">');
  modal.find('button[type=submit]').html('Update');
  modal.modal('show');
}