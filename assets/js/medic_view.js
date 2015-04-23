$(document).ready(function() {
    $('#medic_view_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?medic=1&view_dt=1"
    } );
} );