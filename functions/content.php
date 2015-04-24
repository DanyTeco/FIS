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
		$result=$db->prepare("INSERT INTO pacient_data(`cid`, `title`, `data`, `files`, `author`, `cd`) VALUES(:cid, :titlu, :data, :files, :author, :cd)");
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

?>