$(document).ready(function() {
    $('#laborant_view_table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "index.php?laborant=1&view_dt=1"
    } );
} );