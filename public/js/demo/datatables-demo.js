// Call the dataTables jQuery plugin
$(document).ready(function() {

  if(typeof table_ajax_url !== 'undefined')
  {
	$('#dataTable').DataTable({
		"dom": 'Bfrtip',
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": table_ajax_url,
            "type": "POST"
        }
    });  
	  
	  
  }
  
  else
	  
	  {
		$('#dataTable').DataTable();  
	  }
});
