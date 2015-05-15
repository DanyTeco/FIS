<div class="page medic_prog">

	<div class="title">Programarile mele</div>
    
    <table id="laborant_myprog_table" cellspacing="0" class="cell-border stripe hover">
            <thead>
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Data programarii</th>
                </tr>
            </thead>
        
            <tfoot>
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Data programarii</th>
                </tr>
            </tfoot>
        </table>
    
    
    
    
    <div class="title">Adauga o programare noua</div>
    
     <div class="content">
     <form method="post" action="./?laborant=1&medic_new_prog=1">
        <table id="laborant_new_prog_table" cellspacing="0" class="cell-border stripe hover">
            <thead>
                <tr>
                	<th>Select</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                </tr>
            </thead>
        
            <tfoot>
                <tr>
                	<th>Select</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                </tr>
            </tfoot>
        </table>
        
     <div class="form-group">
     	<div class="row">
     	<div class="col-sm-4">
            <label>Data</label>
            <input tpye="text" class="form-control" id="datepicker1" name="data" />
        </div>
        <div class="col-sm-2">
        	<label>Ora</label>
            <select name="ora" class="form-control">
            	<option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
        	</select>
        </div>
         <div class="col-sm-2">
        	<label>Minute</label>
            <select name="min" class="form-control">
            	<option value="00">00</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
        	</select>
        </div>
       </div><!-- row -->
     </div>
     <div class="form-group">
     	<label>Loc</label>
        <select name="loc" class="form-control">
        	<option value="0">-Alege-</option>
            <option value="Cabinet 1">Cabinet1</option>
            <option value="Cabinet 2">Cabinet2</option>
            <option value="Laborator analize">Laborator analize</option>
            <option value="Laborator radiografie">Laborator radiografie</option>
        </select>
     </div>
      <div class="form-group">
     	<label>Catre</label>
        <select name="pers" class="form-control">
        	<option value="0">-Alege-</option>
            <?php
				global $db;
				$result=$db->prepare("SELECT * FROM user WHERE (type=? AND uid=?) OR type=? ORDER BY type DESC");
				$result->execute(array('medic', $_SESSION['user']['uid'], 'laborant'));
				$row=$result->fetchAll(PDO::FETCH_ASSOC);
				for($i=0;$i<count($row);$i++)
				{
					echo '<option value="'.$row[$i]['uid'].'">'.$row[$i]['type'].': '.$row[$i]['nume'].' '.$row[$i]['prenume'].'</option>';	
				}
			
			?>
        </select>
     </div>
	<div class="form-group text-center">
    	<input type="submit" value="Trimite" class="btn btn-success" />
    </div>   
    </form>    
	</div><!--content -->
    
    
</div>