<div class="page admin_users">
<div class="title">Utilizatori</div>
<?php
global $db;
$result=$db->query("SELECT * FROM user");
$row=$result->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="table table-hover table-bordered">
<tr><th>Nr.Crt</th><th>Nume</th><th>Prenume</th><th>User</th><th>Tip</th><th>Optiuni</th></tr>
<?php
for($i=0;$i<count($row);$i++)
{
	echo '<tr><td>'.($i+1).'</td><td>'.$row[$i]['nume'].'</td><td>'.$row[$i]['prenume'].'</td><td>'.$row[$i]['user'].'</td><td>'.$row[$i]['type'].'</td><td>'.($row[$i]['type']!='admin' ? '<a href="./?admin=1&del_user='.$row[$i]['uid'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a> ' : '').'</td></tr>';
}

?>
</table>

<div class="title">Adauga utilizator nou</div>

<div class="col-sm-6 col-sm-offset-3">
<form method="post" action="./?admin=1&new_user=1">
	<div class="form-group">
    	<label>Nume</label>
        <input type="text" name="nume" class="form-control" />
    </div>
    <div class="form-group">
    	<label>Prenume</label>
        <input type="text" name="prenume" class="form-control" />
    </div>
    <div class="form-group">
    	<label>User</label>
        <input type="text" name="user" class="form-control" />
    </div>
    <div class="form-group">
    	<label>Tip</label>
        <select name="type" class="form-control">
        	<option value="registratura">Registratura</option>
            <option value="medic">Medic</option>
            <option value="laborant">Laborant</option>
        </select>
    </div>
    <div class="form-group">
    	<label>Licenta</label>
        <input type="text" name="licenta" class="form-control" />
    </div>
    <div class="form-group">
    	<label>Parola</label>
        <input type="password" name="pass" class="form-control" />
    </div>
    <div class="form-group text-center">
    	<input type="submit" value="Adauga" class="btn btn-success" />
    </div>
</form>
</div>

</div>