<?php
	global $db;
	$result=$db->prepare("SELECT * FROM clients WHERE cid=?");
	$result->execute(array($_GET['edit_c']));
	$row=$result->fetch(PDO::FETCH_ASSOC);
	
	
?>

<div class="page reg_edit">

<div class="title">Editare pacient</div>

<div class="col-sm-8">
	<form method="post" action="./?reg=1&do_edit=1">
    <input type="hidden" value="<?php echo $row['cid']; ?>" name="cid" />
    	<div class="form-group">
        	<label>Nume</label>
            <input type="text" name="nume" class="form-control" value="<?php echo $row['nume']; ?>" />
        </div>
        <div class="form-group">
        	<label>Prenume</label>
            <input type="text" name="prenume" class="form-control" value="<?php echo $row['prenume']; ?>" />
        </div>
        <div class="form-group">
        	<label>CNP</label>
            <input type="text" name="cnp" class="form-control" value="<?php echo $row['cnp']; ?>" />
        </div>
        <div class="form-group">
        	<label>Adresa</label>
            <input type="text" name="adresa" class="form-control" value="<?php echo $row['adresa']; ?>" />
        </div>
        <div class="form-group">
        	<label>Localitatea</label>
            <input type="text" name="loc" class="form-control" value="<?php echo $row['loc']; ?>" />
        </div>
        <div class="form-group">
        	<label>Telefon</label>
            <input type="text" name="telefon" class="form-control" value="<?php echo $row['telefon']; ?>" />
        </div>
        <div class="form-group">
        	<label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>" />
        </div>
        
        <div class="form-group text-center">
        	<input type="submit" value="Editeaza" class="btn btn-info btn-sm" /> <a href="index.php?reg=1&del=<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Esti sigur ca vrei sa stergi pacientul <?php echo $row['nume'].' '.$row['prenume']; ?>')">Sterge pacient</a>
        </div>    
    </form>

</div>

<div class="col-sm-4">
	Short help or description

</div>


</div>