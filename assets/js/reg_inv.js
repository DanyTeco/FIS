$(document).ready(function() {
    $('#reg_inv_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?reg=1&inv_dt=1",
		dom: 'T<"clear">lfrtip',
		 tableTools: {
            "aButtons": [ "copy", "print" ]
        }
    } );
} );