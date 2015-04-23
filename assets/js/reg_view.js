$(document).ready(function() {
    $('#reg_view_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?reg=1&view_dt=1"
    } );
} );