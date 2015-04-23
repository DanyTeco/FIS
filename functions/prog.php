<?php

function prog_view_dt()
{

$table = 'prog';
$primaryKey = 'prid';
 

$columns = array(
    array( 'db' => 'nume', 'dt' => 0 ),
    array( 'db' => 'prenume',  	'dt' => 1 ),
    array( 'db' => 'cid',   	'dt' => 2 ),
	array( 'db' => 'loc',     	'dt' => 3 ),
	array( 'db' => 'pers',     	'dt' => 4 ),
	array( 'db' => 'data',     	'dt' => 5 ),
	array(
        'db'        => 'prid',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
            return '<a href="./?reg=1&edit_c='.$d.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>';
        }
    )
    
);
  
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns )
);

	
}

function new_prog_dt()
{

	$table = 'clients';
	$primaryKey = 'cid';
	 
	
	$columns = array(
		array( 
				'db' => 'cid',
				'dt' => 0,
				'formatter' => function( $d, $row ) {
					return '<input type="radio" name="cid" value="'.$d.'" />';
				}
			 ),
		array( 'db' => 'nume',  	'dt' => 1 ),
		array( 'db' => 'prenume',  	'dt' => 2 )
		
	);
	  
	 
	echo json_encode(
		SSP::simple( $_GET, $table, $primaryKey, $columns )
	);

	
}

?>