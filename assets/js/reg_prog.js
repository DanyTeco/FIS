$(document).ready(function() {
    $('#reg_prog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?reg=1&prog_dt=1"
    } );
	
	
	 $('#reg_new_prog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?reg=1&new_prog_dt=1"
    } );
	
	
	$( "#datepicker1" ).datepicker({
		 dateFormat : 'yy-mm-dd'	
	});
} );