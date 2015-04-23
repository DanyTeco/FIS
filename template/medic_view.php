<?php
	global $db;
	$id=$_GET['view'];
	$result=$db->prepare("SELECT * FROM clients WHERE cid=?");
	$result->execute(array($id));
	
	if($result->rowCount()!=1)
	{
		set_msg('error', 'Invalid request. Internal error');
		set_msg('error', 'Medic View Client: DB Error - rowCount!=0', 0, 1, 'CID:'.$id);
		header('Location ./');
		exit();	
	}
	
	$client=$result->fetch(PDO::FETCH_ASSOC);
	$result=$db->prepare("SELECT * FROM content WHERE cid=?");
	$result->execute(array($id));
	$data=$result->fetchAll(PDO::FETCH_ASSOC);
	
?>

<div class="page medic_view">

	<div class="title"><?php echo $client['nume'].' '.$client['prenume']; ?></div>



</div>