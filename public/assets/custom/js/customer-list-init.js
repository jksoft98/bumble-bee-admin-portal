$(function () {
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
        { targets: 10, orderable: false }
      ],
      "order": [[0, 'desc']],
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });