<?php


function user_auth()
{
	global $db;
	if(!isset($_POST['user']) || strlen($_POST['user'])<3)
	{
		set_msg('error', 'Formular completat incorect', '001000001-001');
		header('Location: ./');
		exit();	
	}
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	
	$result=$db->prepare("SELECT * FROM user WHERE user=?");
	$result->execute(array($user));
	if($result->rowCount()==0)
	{
		set_msg('error', 'Utilizator inexistent', '001000001-002');
		header('Location: ./');
		exit();	
	}
	else
	{
		$row=$result->fetch(PDO::FETCH_ASSOC);
		//print_r($row);
		if($row['pass']!=md5($pass))
		{
			set_msg('error', 'Parola introdusa este incorecta', '001000001-003');
			header('Location: ./');
			exit();	
		}
		else
		{
			$_SESSION['user']=array();
			$_SESSION['user']['uid']=$row['uid'];
			$_SESSION['user']['type']=$row['type'];
			$_SESSION['user']['nume']=$row['nume'];
			$_SESSION['user']['prenume']=$row['prenume'];
			update_user_log($row['uid'], 'login');
			//print_r($_SESSION);
			//exit();			
		}
	}
	set_msg('success', 'Autentificare reusita. Bine ai venit!');
	header('Location: ./');
	exit();	
}


function update_user_log($id, $type)
{
	global $db;
	
	$params=array();
	$params[':uid']=$id;
	$params[':key']=$type;
	$params[':value']=date('Y-m-d H:i:s');
	
	$result=$db->prepare("INSERT INTO user_log(`uid`, `key`, `value`) VALUES(:uid, :key, :value)");
	$result->execute($params);
}

function logout()
{
	update_user_log($_SESSION['user']['uid'], 'logout');
	$_SESSION['user']=array();
	unset($_SESSION['user']);
	header('Location: ./');
	exit();	
}


function have_rights($type)
{
	if(isset($_SESSION['user']) && is_numeric($_SESSION['user']['uid']))
	{
		if($type==$_SESSION['user']['type'])
			return 1;
		elseif($_SESSION['user']['type']=='admin')
			return 1;
		else
			return 0;
		
	}
	else
		return 0;
}


function get_user($id)
{
	global $db;
	
	$result=$db->prepare("SELECT nume, prenume, type, licenta FROM user WHERE uid=?");
	$result->execute(array($id));
	
	return $result->fetch(PDO::FETCH_ASSOC);	
}


function delete_user()
{
	global $db;
	$id=$_GET['del_user'];
	
	$result=$db->prepare("DELETE FROM user WHERE uid=?");
	$result->execute(array($id));
	
	set_msg('success', 'Utilizator sters cu success');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();	
	
}

function new_user()
{
	global $db;
	$fields=array('nume', 'prenume', 'type', 'licenta', 'user', 'pass');
	
	$ok=1;
	for($i=0;$i<count($fields);$i++)
		if(strlen($_POST[$fields[$i]])<2)
			$ok=0;
			
	
	
	if($ok)
	{
		$params=array();
		$params[':nume']=filter_var($_POST['nume'], FILTER_SANITIZE_STRING);
		$params[':prenume']=filter_var($_POST['prenume'], FILTER_SANITIZE_STRING);
		$params[':type']=filter_var($_POST['type'], FILTER_SANITIZE_STRING);
		$params[':licenta']=filter_var($_POST['licenta'], FILTER_SANITIZE_STRING);
		$params[':user']=filter_var($_POST['user'], FILTER_SANITIZE_STRING);
		$params[':pass']=md5($_POST['pass']);	
		
		$params[':dc']=date('Y-m-d');
		
	
		$result=$db->prepare("INSERT INTO user(`nume`, `prenume`, `user`, `type`, `licenta`, `pass`, `dc`) VALUES(:nume, :prenume, :user, :type, :licenta, :pass, :dc)");
		$result->execute($params);
	
	
		set_msg('success', 'Utilizator adaugat cu success.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	
	}
	else
	{
		set_msg('error', 'Toate campurile sunt obligatorii.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
}









?>