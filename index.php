<?php
include("include/top.php");
include("functions/functions.php");

$assets1=array();
$assets2=array();
$files=array();


array_push($assets1, array('css', 'css/bootstrap.min.css'));
array_push($assets1, array('script', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'));
array_push($assets1, array('script', 'js/bootstrap.min.js'));

if(!isset($_SESSION['user']) || !is_numeric($_SESSION['user']['uid']))
{
	if(isset($_GET['auth']) && $_GET['auth']==1)
	{
		user_auth();	
	}
	else
	{
		array_push($assets1, array('css', 'css/auth.css'));
		array_push($files, 'header.php', 'auth.php',  'footer.php');
		load_template($files, $assets1, $assets2);		
	}
exit();
}
if(isset($_GET['logout']) && $_GET['logout']==1)
{
	logout();	
}
elseif(isset($_GET['m']) && $_GET['m']=='cab')
{
	//	
}
elseif(isset($_GET['reg']) && $_GET['reg']==1)
{
	if(!have_rights('registratura'))
	{
		set_msg('error', 'Nu aveti suficiente drepturi pentru aceasta arie');
		header('Location: ./');
		exit();
	}
	
	if(isset($_GET['new']) && $_GET['new']==1)
	{
		array_push($assets1, array('css', 'css/main.css'));
		array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', 'reg_new.php', 'after-c.php',  'footer.php');
		load_template($files, $assets1, $assets2);
	}
	elseif(isset($_GET['add_new']) && $_GET['add_new']==1)
	{
		new_client();
	}
	elseif(isset($_GET['do_edit']) && $_GET['do_edit']==1)
	{
		edit_client();
	}
	elseif(isset($_GET['del']) && is_numeric($_GET['del']))
	{
		del_client();
	}
	elseif(isset($_GET['view']) && $_GET['view']==1)
	{
		array_push($assets1, array('css', 'css/main.css'));
		array_push($assets1, array('css', 'css/jquery.dataTables.min.css'));
		array_push($assets1, array('css', 'css/jquery.dataTables_themeroller.css'));
		array_push($assets1, array('script', 'js/jquery.dataTables.min.js'));
		array_push($assets1, array('script', 'js/reg_view.js'));
		array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', 'reg_view.php', 'after-c.php',  'footer.php');
		load_template($files, $assets1, $assets2);	
	}
	elseif(isset($_GET['prog']) && $_GET['prog']==1)
	{
		array_push($assets1, array('css', 'css/main.css'));
		array_push($assets1, array('css', 'css/jquery.dataTables.min.css'));
		array_push($assets1, array('css', 'css/jquery.dataTables_themeroller.css'));
		array_push($assets1, array('css', 'https://code.jquery.com/ui/1.11.4/themes/ui-darkness/jquery-ui.css'));
		array_push($assets1, array('script', 'js/jquery.dataTables.min.js'));
		array_push($assets1, array('script', 'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'));
		array_push($assets1, array('script', 'js/reg_prog.js'));
		array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', 'reg_programari.php', 'after-c.php',  'footer.php');
		load_template($files, $assets1, $assets2);	
	}
	elseif(isset($_GET['view_dt']) && $_GET['view_dt']==1)
	{
		clients_view_dt();
		exit();	
	}
	elseif(isset($_GET['prog_dt']) && $_GET['prog_dt']==1)
	{
		prog_view_dt();
		exit();	
	}
	elseif(isset($_GET['new_prog_dt']) && $_GET['new_prog_dt']==1)
	{
		new_prog_dt();
		exit();	
	}
	elseif(isset($_GET['do_new_prog']) && $_GET['do_new_prog']==1)
	{
		add_new_prog();	
	}
	elseif(isset($_GET['edit_c']) && is_numeric($_GET['edit_c']))
	{
		array_push($assets1, array('css', 'css/main.css'));
		array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', 'reg_edit.php', 'after-c.php',  'footer.php');
		load_template($files, $assets1, $assets2);
	}
	else
	{
		array_push($assets1, array('css', 'css/main.css'));
		array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', 'registratura_fp.php', 'after-c.php',  'footer.php');
		load_template($files, $assets1, $assets2);
	}
	
	
}
else
{
	$type=$_SESSION['user']['type'];
	array_push($assets1, array('css', 'css/main.css'));
	array_push($files, 'header.php', 'left.php', 'before-c.php', 'top.php', $type.'_fp.php', 'after-c.php',  'footer.php');
	load_template($files, $assets1, $assets2);			
}



?>