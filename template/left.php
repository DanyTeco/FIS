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
            <li><a href="./?reg=1&inc=1">Incasari</a></li>
            <li><a href="./?reg=1&r=1">Rapoarte</a></li>
	<?php
		elseif($type=='medic'):
	?>
    		<li><a href="./">Cabinet</a></li>
            <li><a href="./?medic=1&view=1">Vizualizare pacient</a></li>
            <li><a href="./?medic=1&prog=1">Programari</a></li>
            <li><a href="./?medic=1&r=1">Rapoarte</a></li>
	<?php
		elseif($type=='laborant'):
	?>
    		<li><a href="./">Laborator</a></li>
            <li><a href="./?lab=1&view=1">Vizualizare pacient</a></li>
            <li><a href="./?lab=1&prog=1">Programari</a></li>
            <li><a href="./?lab=1&hw=1">Echipament</a></li>
            <li><a href="./?lab=1&r=1">Rapoarte</a></li>
	<?php
		endif;
	?>
</ul>


</div>