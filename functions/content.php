<?php

function new_content()
{
	global $db; 
	
	if(!isset($_POST['cid']) || !is_numeric($_POST['cid']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	
	
	$cid=$_POST['cid'];
	$titlu=$_POST['titlu'];
	$data=$_POST['data'];
	$files=file_upload_by_name('fis');	
	$author=$_SESSION['user']['uid'];
	$cd=date('Y-m-d H:i:s');
	
	$params=array();
	$params[':cid']=$cid;
	$params[':titlu']=$titlu;
	$params[':data']=$data;
	$params[':files']=implode('**', $files);
	$params[':author']=$author;
	$params[':cd']=$cd;
	
	try
	{
		$result=$db->prepare("INSERT INTO content(`cid`, `title`, `data`, `files`, `author`, `cd`) VALUES(:cid, :titlu, :data, :files, :author, :cd)");
		$result->execute($params);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		set_msg('error', 'Add new content DB ERR', 0, 1, '', $e->getCode().':'.$e->getMessage());
		set_msg('error', 'Internal error. Please try again later');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	
	set_msg('success', 'Continut adaugat cu succes');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
	
}


function new_recipes()
{
	global $db; 
	
	if(!isset($_POST['cid']) || !is_numeric($_POST['cid']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	
	
	$cid=$_POST['cid'];
	if(!isset($_POST['dcod']) || !isset($_POST['diagnostic']) || strlen($_POST['dcod'])<1 || strlen($_POST['diagnostic'])<3)
	{
		set_msg('error', 'Va rugam sa introduceti un diagnostic valid. (Cod-Denumire)');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	$dcod=$_POST['dcod'];
	$diagnostic=$_POST['diagnostic'];
	
	if(!isset($_POST['content']) || strlen($_POST['content'])<2)
	{
		set_msg('error', 'Completati lista de medicamente');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
			
	}
	$content=$_POST['content'];
	
	$params=array();
	$params[':cid']=$cid;
	$params[':diagnosis']=$dcod.' - '.$diagnostic;
	$params[':content']=$content;
	$params[':author']=$_SESSION['user']['uid'];
	$params[':cd']=date('Y-m-d H:i:s');
	
	$result=$db->prepare("INSERT INTO recipes(`cid`, `diagnosis`, `content`, `author`, `cd`) VALUES(:cid, :diagnosis, :content, :author, :cd)");
	$result->execute($params);
	
	set_msg('success', 'Reteta adaugata cu success');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();	
	
	
}

function new_referral()
{
	global $db; 
	
	if(!isset($_POST['cid']) || !is_numeric($_POST['cid']))
	{
		set_msg('error', 'Cerere invalida!');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	
	
	$cid=$_POST['cid'];
	
	if(!isset($_POST['to']) && strlen($_POST['to'])<2)
	{
		set_msg('error', 'Completati campul "Catre".');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();		
	}
	$to=$_POST['to'];
	
	if(!isset($_POST['dcod']) || !isset($_POST['diagnostic']) || strlen($_POST['dcod'])<1 || strlen($_POST['diagnostic'])<3)
	{
		set_msg('error', 'Va rugam sa introduceti un diagnostic valid. (Cod-Denumire)');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
	}
	
	$dcod=$_POST['dcod'];
	$diagnostic=$_POST['diagnostic'];
	
	if(!isset($_POST['content']) || strlen($_POST['content'])<2)
	{
		set_msg('error', 'Completati lista de medicamente');
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();	
			
	}
	$content=$_POST['content'];
	
	$params=array();
	$params[':cid']=$cid;
	$params[':to']=$to;
	$params[':diagnosis']=$dcod.' - '.$diagnostic;
	$params[':content']=$content;
	$params[':author']=$_SESSION['user']['uid'];
	$params[':cd']=date('Y-m-d H:i:s');
	
	$result=$db->prepare("INSERT INTO referrals(`cid`, `to`, `diagnosis`, `content`, `author`, `cd`) VALUES(:cid, :to, :diagnosis, :content, :author, :cd)");
	$result->execute($params);
	
	set_msg('success', 'Trimitere adaugata cu success');
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();	
	
	
}

?>