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
			update_user_log($row['id'], 'login');
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
	//	
}

function logout()
{
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






?>