<?php

function set_msg($type, $msg, $showtousr=1, $addtolog=0, $info='')
{
	global $db;
	//type		:		[error,warning,success,info]
	//msg		:		message for user. Use _() for translation
	//showtousr :		1 if message need to be showed to user, 0 otherwise
	//addtolog  :		1 if message need to be added in log file or database, 0 otherwise
	//info		:		Additional message to add in log file or database
		
	if($showtousr)
	{
		$_SESSION['msg']=array();
		$_SESSION['msg']['type']=$type;
		$_SESSION['msg']['msg']=$msg;			
	}
	
	if($addtolog)
	{
		$params=array();
		$params[':type']=$type;
		$params[':title']=$msg;
		$params[':msg']=$info;
		$params[':cd']=date('Y-m-d H:i:s');
		
		$result=$db->prepare("INSERT INTO `log`(`type`, `title`, `msg`, `cd`) VALUES(:type, :title, :msg, :cd)");
		$result->execute($params);	
		
		mail(DEV_EMAIL, $_SERVER['HTTP_HOST'].' ERR:'. $msg, date('Y-m-d H:i:s').':'.$info);
	}
		
		
	
}

function show_msg()
{
	if(isset($_SESSION['msg']) && strlen($_SESSION['msg']['msg'])>0)
	{
		echo '<div class="alert alert-'.($_SESSION['msg']['type']=='error' ? 'danger' : $_SESSION['msg']['type']).'" role="alert">'.$_SESSION['msg']['msg'].'</div>';	
	}
	
	$_SESSION['msg']=array();
	unset($_SESSION['msg']);
}



?>