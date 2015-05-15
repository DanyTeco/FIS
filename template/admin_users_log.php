<div class="page">

<table id="admin_user_log" class="cell-border" cellspacing="0" width="100%">
<thead>
	<tr><th>Nume utilizator</th><th>Tip</th><th>Data</th></tr>
</thead>
<tbody>
	<?php
    global $db;
    $result=$db->query("SELECT * FROM user_log AS ul JOIN user AS u  ON ul.uid=u.uid");
    $row=$result->fetchAll(PDO::FETCH_ASSOC);
    
    for($i=0;$i<count($row);$i++)
    {
        echo '<tr><td>'.$row[$i]['nume'].' '.$row[$i]['prenume'].'</td><td>'.$row[$i]['key'].'</td><td>'.$row[$i]['value'].'</td></tr>';	
    }
    
    
    ?>
</tbody>
</table>

</div>