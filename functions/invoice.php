<?php


function new_invoice()
{
	global $db;
	if(!isset($_POST['cid']) || !is_numeric($_POST['cid']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	$cid=$_POST['cid'];
	
	
	
	if(!isset($_POST['suma']) && is_numeric($_POST['suma']))
	{
		set_msg('err', 'Suma incorecta sau lipsa!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();		
	}
	
	$suma=$_POST['suma'];
	
	$info=$_POST['info'];
	
	$data=date('Y-m-d H:i:s');
	$params=array();
	$params[':cid']=$cid;
	$params[':data']=$data;
	$params[':val']=$suma;
	$params[':user']=$_SESSION['user']['uid'];
	$params[':info']=$info;
	try
	{
		$result=$db->prepare("INSERT INTO invoice(`cid`, `cd`, `val`, `author`, `info`) VALUES(:cid, :data, :val, :user, :info)");
		$result->execute($params);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		set_msg('error', 'Add new invoice DB ERR', 0, 1, '', $e->getCode().':'.$e->getMessage());
		set_msg('error', 'Internal error. Please try again later');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	set_msg('success', 'Factura adaugata cu succes');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
	
}

function invoice_dt($type='')
{

$table = 'invoice';
$primaryKey = 'invid';
 

$columns = array(
    array( 'db' => 'invid', 'dt' => 0 ),
    array( 'db' => 'cid',  'dt' => 1,
	'formatter' => function( $d, $row ) {
			$client=get_client($d);
			return $client['nume'].' '.$client['prenume'];
        } ),
    array( 'db' => 'val',   'dt' => 2 ),
    array( 'db' => 'author',     'dt' => 3, 
			'formatter' => function( $d, $row ) {
			$client=get_user($d);
			return $client['nume'].' '.$client['prenume'];
        } ),
	array( 'db' => 'cd',     'dt' => 4 ),
	array( 'db' => 'incasat',     'dt' => 5),
	array( 'db' => 'incasat',     'dt' => 6,
	'formatter' => function( $d, $row ) {
			return $row['val']-$d;
        } ),
	
	array( 'db' => 'invid',     'dt' => 7,
	'formatter' => function( $d, $row ) {
			return '<a href="./?reg=1&inv=1&edit='.$d.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></a>';
        } )
    
);
  
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns )
);

	
}


function edit_inv()
{
	global $db;
	if(!isset($_POST['invid']) || !is_numeric($_POST['invid']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	if(!isset($_POST['incasat']) &&  !is_numeric($_POST['incasat']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	try
	{
		$result=$db->prepare("UPDATE invoice SET incasat=? WHERE invid=?");
		$result->execute(array($_POST['incasat'], $_POST['invid']));
	}
	catch(PDOException $e)
	{
		//echo $e->getMessage();
		set_msg('error', 'Edit invoice DB ERR', 0, 1, '', $e->getCode().':'.$e->getMessage());
		set_msg('error', 'Internal error. Please try again later');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

	set_msg('success', 'Factura editata cu succes');
	header('Location: ./?reg=1&inv=1');
	exit();
}




?>