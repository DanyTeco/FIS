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

	<div class="row text-center">
    	<div class="col-sm-4"><b>CNP:</b><?php echo $client['cnp']; ?></div>
        <div class="col-sm-4"><b>Adresa:</b><?php echo $client['adresa']; ?></div>
        <div class="col-sm-4"><b>Localitatea:</b><?php echo $client['loc']; ?></div>
    </div>
    <div class="row text-center">
    	<div class="col-sm-4"><b>Telefon:</b><?php echo $client['telefon']; ?></div>
        <div class="col-sm-4"><b>Email:</b><?php echo $client['email']; ?></div>
        <div class="col-sm-4"><b>Inregistrat in:</b><?php echo $client['cd']; ?></div>
    </div>

<hr  />


<form method="post" action="./?medic=1&new_content=1" enctype="multipart/form-data">
    <div class="form-group">
        <label>Titlu</label>
        <input name="titlu" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Continut</label>
        <textarea name="data" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Fisiere</label>
        <input name="fis[]" type="file" multiple="multiple" />
    </div>
    
    <div class="form-group text-center">
        <input type="submit" class="btn btn-success" value="Adauga" />
    </div>
</form>



</div>