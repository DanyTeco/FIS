<?php

function new_client()
{
	global $db;
	
	$fields=array('nume', 'prenume', 'cnp', 'adresa', 'loc', 'telefon', 'email');
	
	$empty=0;
	for($i=0;$i<count($fields);$i++)
		if(strlen($_POST[$fields[$i]])<2)
			$empty=1;
			
	
	
	if(!$empty)
	{
		$params=array();
		for($i=0;$i<count($fields);$i++)
			$params[':'.$fields[$i]]=filter_var($_POST[$fields[$i]], FILTER_SANITIZE_STRING);	
		
		$params[':cd']=date('Y-m-d H:i:s');
		
		//print_r($params);
	
		$result=$db->prepare("INSERT INTO clients(`nume`, `prenume`, `cnp`, `adresa`, `loc`, `telefon`, `email`, `cd`) VALUES(:nume, :prenume, :cnp, :adresa, :loc, :telefon, :email, :cd)");
		$result->execute($params);	
		
		
		set_msg('success', 'Client adaugat cu success');
		header('Location: ./?reg=1&view=1');
		exit();
			
	}
	else
	{
		set_msg('error', 'Toate campurile sunt obligatorii!. Completati corect formularul.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
}
function edit_client()
{
	global $db;
	
	if(!isset($_POST['cid']) || !is_numeric($_POST['cid']))
	{
		set_msg('error', 'A aparut o problema interna. Va rugam reveniti!');
		set_msg('error', 'Registratura - Update client - NO `cid` value', 0, 1);	
		header('Location: ./?reg=1&view=1');
		exit();
	}
	
	$fields=array('nume', 'prenume', 'cnp', 'adresa', 'loc', 'telefon', 'email');
	
	$empty=0;
	for($i=0;$i<count($fields);$i++)
		if(strlen($_POST[$fields[$i]])<2)
			$empty=1;
			
	
	
	if(!$empty)
	{
		$params=array();
		for($i=0;$i<count($fields);$i++)
			$params[':'.$fields[$i]]=filter_var($_POST[$fields[$i]], FILTER_SANITIZE_STRING);	
		
		$params[':cid']=$_POST['cid'];
		
		//print_r($params);
	
		$result=$db->prepare("UPDATE clients SET `nume`=:nume, `prenume`=:prenume, `cnp`=:cnp, `adresa`=:adresa, `loc`=:loc, `telefon`=:telefon, `email`=:email WHERE cid=:cid");
		$result->execute($params);	
		
		
		set_msg('success', 'Client modificat cu success');
		header('Location: ./?reg=1&view=1');
		exit();
			
	}
	else
	{
		set_msg('error', 'Toate campurile sunt obligatorii!. Completati corect formularul.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
}

function del_client()
{
	global $db;
	$id=$_GET['del'];
	$result=$db->prepare("DELETE FROM clients WHERE cid=?");
	$result->execute(array($id));
	
	set_msg('success', 'Pacient sters cu success');
	header('Location: ./?reg=1&view=1');
	exit();	
	
}



function clients_view_dt($type='')
{

$table = 'clients';
$primaryKey = 'cid';
 

$columns = array(
    array( 'db' => 'nume', 'dt' => 0 ),
    array( 'db' => 'prenume',  'dt' => 1 ),
    array( 'db' => 'cnp',   'dt' => 2 ),
    array( 'db' => 'adresa',     'dt' => 3 ),
	array( 'db' => 'loc',     'dt' => 4 ),
	array( 'db' => 'telefon',     'dt' => 5 ),
	array( 'db' => 'email',     'dt' => 6 ),
	array( 'db' => 'cd',     'dt' => 7 ),
	array(
        'db'        => 'cid',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
			if(isset($_SESSION['user']['type']) && ($_SESSION['user']['type']=='medic' || $_SESSION['user']['type']=='laborant'))
				return '<a href="./?'.$_SESSION['user']['type'].'=1&view='.$d.'" class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>';
			elseif(isset($_SESSION['user']['type']) && $_SESSION['user']['type']=='registratura')
            	return '<a href="./?reg=1&edit_c='.$d.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>';
			else
				return "-";
        }
    )
    
);
  
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns )
);

	
}

function get_client($id)
{
	global $db;
	
	$result=$db->prepare("SELECT * FROM clients WHERE cid=?");
	$result->execute(array($id));
	
	return $result->fetch(PDO::FETCH_ASSOC);	
}


?>