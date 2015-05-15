<?php

function prog_view_dt()
{

$table = 'prog';
$primaryKey = 'prid';
 

$columns = array(
    array( 'db' => 'nume',		'dt' => 0 ),
    array( 'db' => 'prenume',  	'dt' => 1 ),
    array( 'db' => 'cid',   	'dt' => 2 ),
	array( 'db' => 'loc',     	'dt' => 3 ),
	array( 'db' => 'pers',     	'dt' => 4,
	'formatter' => function( $d, $row ) {
		$u=get_user($d);
		return $u['nume'].' '.$u['prenume'];
	}),
	array( 'db' => 'data',     	'dt' => 5 ),
	array(
        'db'        => 'prid',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
			if($_SESSION['user']['type']=='registratura')
            	return '<a href="./?reg=1&delete_prog='.$d.'" class="btn btn-danger btn-sm" onClick="return confirm(\'Esti sigur ca vrei sa stergi aceasta programare?\'); "><span class="glyphicon glyphicon-remove"></span></a>';
			else
				return '';
        }
    )
    
);
  
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns )
);

	
}

function myprog_dt()
{

$table = 'prog';
$primaryKey = 'prid';
 

$columns = array(
    array( 'db' => 'nume',		'dt' => 0 ),
    array( 'db' => 'prenume',  	'dt' => 1 ),
	array( 'db' => 'data',     	'dt' => 2 )
    );
    


$where=array('pers'=>$_SESSION['user']['uid']);
  
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns, $where )
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

function add_new_prog()
{
	global $db;
	$fields=array('cid', 'data', 'ora', 'min', 'loc', 'pers');
	
	$empty=0;
	for($i=0;$i<count($fields);$i++)
		if(strlen($_POST[$fields[$i]])==0)
			$empty=1;

	if(!$empty)
	{
		$result=$db->prepare("SELECT * FROM clients WHERE cid=?");
		$result->execute(array($_POST['cid']));
		$row=$result->fetch(PDO::FETCH_ASSOC);
		$params=array();
		$params[':nume']=$row['nume'];
		$params[':prenume']=$row['prenume'];
		$params[':cid']=$_POST['cid'];
		$params[':data']=$_POST['data'].' '.$_POST['ora'].':'.$_POST['min'].':00';
		$params[':loc']=$_POST['loc'];
		$params[':author']=$_SESSION['user']['uid'];
		$params[':pers']=$_POST['pers'];
		$params[':cd']=date('Y-m-d H:i:s');	
			
			
		$result=$db->prepare("INSERT INTO prog(`nume`, `prenume`, `cid`, `data`, `loc`, `pers`, `author`, `cd`) VALUES(:nume, :prenume, :cid, :data, :loc, :pers, :author, :cd)");
		$result->execute($params);	
		
		
		set_msg('success', 'Programare adaugata cu success');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	
	}
	else
	{
		set_msg('error', 'Toate campurile sunt obligatorii!. Completati corect formularul.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
}

function delete_prog()
{
	global $db;
	$del=$_GET['delete_prog'];
	
	$result=$db->prepare("DELETE FROM prog WHERE prid=?");
	$result->execute(array($del));	
	
	set_msg('success', 'Programare stearsa cu success.');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();	
	
}

?>