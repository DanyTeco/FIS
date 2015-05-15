<div class="left">

<ul class="nav">
	<?php
		$type=$_SESSION['user']['type'];
		if($type=='registratura'):
	?>
    		<li><a href="./">Registratura</a></li>
            <li><a href="./?reg=1&new=1">Inregistrare pacient</a></li>
            <li><a href="./?reg=1&view=1">Vizualizare pacient</a></li>
            <li><a href="./?reg=1&prog=1">Programari</a></li>
            <li><a href="./?reg=1&inv=1">Facturi/Incasari</a></li>   
	<?php
		elseif($type=='medic'):
	?>
    		<li><a href="./">Cabinet</a></li>
            <li><a href="./?medic=1&g_view=1">Vizualizare pacient</a></li>
            <li><a href="./?medic=1&prog=1">Programari</a></li>
            
	<?php
		elseif($type=='laborant'):
	?>
    		<li><a href="./">Laborator</a></li>
            <li><a href="./?laborant=1&g_view=1">Vizualizare pacient</a></li>
            <li><a href="./?laborant=1&prog=1">Programari</a></li>
	<?php
		elseif($type=='admin'):
	?>
    		<li><a href="./">Administrator</a></li>
            <li><a href="./?reg=1&new=1">Inregistrare pacient</a></li>
            <li><a href="./?reg=1&view=1">Vizualizare pacient</a></li>
            <li><a href="./?reg=1&inv=1">Facturi/Incasari</a></li>
            <li><a href="./?admin=1&users=1">Utilizatori</a></li>
            <li><a href="./?admin=1&users_log=1">Utilizatori log</a></li>
            
            
	<?php
		endif;
	?>
</ul>


</div>