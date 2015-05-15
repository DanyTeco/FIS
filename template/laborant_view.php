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

<div class="client_content">

<?php
	for($i=0;$i<count($data);$i++)
	{
		if($data[$i]['author']==$_SESSION['user']['uid'])
		{
			echo '<div class="cc_title">'.$data[$i]['cd'].': '.$data[$i]['title'].'</div>';
			echo '<div class="cc_content">'.$data[$i]['data'].'</div>';
			
				if(strlen($data[$i]['files'])>0)
				{
					echo '<div class="cc_files">Fisiere:';
					$files=explode('**', $data[$i]['files']);
					for($j=0;$j<count($files);$j++)
						echo '<a href="./uploaded/'.$files[$j].'" class="cc_files_link"><span class="btn btn-info glyphicon glyphicon-save-file"></span> '.$files[$j].'</a>';	
					echo '</div>';
				}
				
			echo '<hr />';
		}
		else
		{
			echo '<div class="cc_error">Nu aveti suficiente drepturi pentru a vedea acest continut!</div>';
			echo '<hr />';	
		}
	}
?>

</div>

<div class="option_btn text-center">
	<a href="#" class="btn btn-info" onclick="show_new_content();">Adauga continut</a>
    <a href="#" class="btn btn-warning" onclick="show_new_invoice();">Emite factura</a>
</div>

<div class="new_content_form">
<div class="title">Adauga continut</div>
<form method="post" action="./?laborant=1&new_content=1" enctype="multipart/form-data">
<input name="cid" type="hidden" value="<?php echo $id; ?>" />
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
    <div class="form-group">
    	<a href="#" class="btn btn-info" onclick="mediqalizer();">MedIQalizer</a>
    	<a href="#" class="btn btn-warning" onclick="mediqrad();">MedIQrad</a>
    </div>
    <div class="form-group text-center">
        <input type="submit" class="btn btn-success" value="Adauga" />
    </div>
</form>
</div>


<div class="new_invoice_form">
<div class="title">Adauga factura</div>
<form method="post" action="./?laborant=1&new_invoice=1">
<div class="col-sm-6 col-sm-offset-3">
<input name="cid" type="hidden" value="<?php echo $id; ?>" />
<div class="form-group">
	<label>Suma</label>
    <input name="suma" class="form-control" type="suma" />
</div>	
<div class="form-group">
	<label>Info</label>
    <textarea name="info" class="form-control" style="height:75px;"></textarea>
</div>	
<div class="form-group text-center"><input type="submit" class="btn btn-success" value="Adauga factura" /></div>
</div>
</form>

</div>

</div>