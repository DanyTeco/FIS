// JavaScript Document

$(document).ready(function() {

	$('#laborant_myprog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?laborant=1&myprog_dt=1"
    } );
	
	$('#laborant_new_prog_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?laborant=1&new_prog_dt=1"
    } );

	$( "#datepicker1" ).datepicker({
		dateFormat : 'yy-mm-dd'	
	});
	
	
	
});