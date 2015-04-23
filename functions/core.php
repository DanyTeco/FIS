<?php

function load_template($files, $assets1=array(), $assets2=array())
{
	if(count($files)>0)
		foreach($files as $file)
			include('template/'.$file);	
	
}

function load_header_files($files)
{
	if(count($files)>0)
		foreach($files as $file)
		{
			if($file[0]=='css')
			{
				if(substr($file[1], 0, 4)=='http')
					echo '<link rel="stylesheet" href="'.$file[1].'">';
				else
					echo '<link rel="stylesheet" href="assets/'.$file[1].'">';
			}
			elseif($file[0]=='script')
			{
				if(substr($file[1], 0, 4)=='http')
					echo '<script src="'.$file[1].'"></script>';
				else
					echo '<script src="assets/'.$file[1].'"></script>';	
			}
		}
				
	
}

function load_footer_files($files)
{
	if(count($files)>0)
		foreach($files as $file)
		{
			if($file[0]=='css')
			{
				if(substr($file[1], 0, 4)=='http')
					echo '<link rel="stylesheet" href="'.$file[1].'">';
				else
					echo '<link rel="stylesheet" href="assets/'.$file[1].'">';
			}
			elseif($file[0]=='script')
			{
				if(substr($file[1], 0, 4)=='http')
					echo '<script src="'.$file[1].'"></script>';
				else
					echo '<script src="assets/'.$file[1].'"></script>';	
			}
		}
				
	
}



?>