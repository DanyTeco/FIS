<?php
function file_upload_by_name($name)
{
  		$input_name=$name;
	
  $uploadDir = "uploaded/";
  $k=0;
 
  $files=array();
 
	for ($i = 0; $i < count($_FILES[$input_name]['name']); $i++) {
	  
	   $ext = substr(strrchr($_FILES[$input_name]['name'][$i], "."), 1); 
	  
	   $fPath = md5(rand() * time()) . ".$ext";
	   
	   $result = move_uploaded_file($_FILES[$input_name]['tmp_name'][$i], $uploadDir . $fPath);
	   if($result)
		  $files[$i]=$fPath;
	}//for
  
return $files;

} //function

?>