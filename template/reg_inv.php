<div class="page reg_inv">
<div class="title">Vizualizare facturi/incasari</div>

<div class="content">

<?php
if(isset($_GET['edit']) && is_numeric($_GET['edit']))
{
	global $db;
	$edit=$_GET['edit'];
		
	$result=$db->prepare("SELECT * FROM invoice WHERE invid=?");
	$result->execute(array($edit));
	
	$inv=$result->fetch(PDO::FETCH_ASSOC);
	
	echo '<div class="box"><div class="title">Editare Factura #'.$edit.'</div>';
	echo '<div class="col-sm-4 col-sm-offset-4">';
	echo '<form method="post" action="./?reg=1&edit_inv=1">';
	echo '<input type="hidden" name="invid" value="'.$edit.'" />';
		echo '<div class="form-group"><label>Incasat</label><input name="incasat" type="text" value="'.$inv['incasat'].'" class="form-control" /></div>';
		echo '<div class="form-group text-center"><input type="submit" class="btn btn-success" value="Modifica!" /></div>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	
}


?>



<table id="reg_inv_table" cellspacing="0" class="cell-border stripe hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pacient</th>
            <th>Suma</th>
            <th>Autor</th>
            <th>Data</th>
            <th>Incasat</th>
            <th>Ramas</th>
            <th>Optiuni</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>ID</th>
            <th>Pacient</th>
            <th>Suma</th>
            <th>Autor</th>
            <th>Data</th>
            <th>Incasat</th>
            <th>Ramas</th>
            <th>Optiuni</th>
        </tr>
    </tfoot>
</table>
</div><!--content -->
</div><!-- page -->