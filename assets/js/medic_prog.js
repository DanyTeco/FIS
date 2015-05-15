// JavaScript Document

$(document).ready(function() {

	$('#medic_myprog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?medic=1&myprog_dt=1"
    } );
	
	$('#medic_new_prog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?medic=1&new_prog_dt=1"
    } );

	$( "#datepicker1" ).datepicker({
		dateFormat : 'yy-mm-dd'	
	});
	
	
	
});