
/*
|--------------------------------------------------------------------------
|function dataTable
|--------------------------------------------------------------------------
*/
$(function () {
    $('#brand-list').DataTable({
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
    }).buttons().container().appendTo('#brand-list_wrapper .col-md-6:eq(0)');
});


/*
|--------------------------------------------------------------------------
|function brand create modal show
|--------------------------------------------------------------------------
*/
function brandCreate(){
  var modal = $('#brandModal');
  $('#brand-id').remove();
  modal.find('.modal-title').html('Create Brand');
  modal.find('form').attr('action', '/brand-create-submit');
  modal.find('#brand_name').val('');
  modal.find('#description').val('');
  modal.find('button[type=submit]').html('Create');
  removeModalRequired(modal);
  modal.modal('show');
}


/*
|--------------------------------------------------------------------------
|function brand edit modal show
|--------------------------------------------------------------------------
*/
function brandEdit(ele){
  var data = JSON.parse(ele.closest('.btn-group').getAttribute('data-parent'));
  var modal = $('#brandModal');
  $('#brand-id').remove();
  modal.find('.modal-title').html('Edit Brand');
  modal.find('form').attr('action', '/brand-edit-submit');
  modal.find('#brand_name').val(data.brand_name);
  modal.find('#description').val(data.description);
  modal.find('.modal-body').append('<input type="hidden" id="brand-id" name="brand_id" value="'+data.id+'">');
  modal.find('button[type=submit]').html('Update');
  removeModalRequired(modal);
  modal.modal('show');
}