// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

$('#dataTable').dataTable( {
  "language": {
    "sSearch": "Αναζήτηση:",
    "lengthMenu": "Προβολή _MENU_ εγγραφών",
    "info": "Προβολή _START_ έως _END_ από _TOTAL_ εγγραφές",
    "paginate": {
      "first": "First",
      "last": "Last",
      "next": "Επόμενο",
      "previous": "Προηγούμενο"
      }
  }
  
}
);