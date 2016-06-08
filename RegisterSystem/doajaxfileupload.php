<?php
	session_start();
	$error = "";
	$msg = "";
	$fileElementName = 'doc';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['doc']['tmp_name']) || $_FILES['doc']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
		$path = "upload/" . $_SESSION['loginName'].$_FILES["doc"]["name"];
		$con = mysql_connect('localhost','root','');
		/*if (!$con){
			die('Could not connect: ' . mysql_error());
		}*/
		mysql_query("SET NAMES UTF8");
		mysql_select_db("account", $con);
//-----------------------------------------------------------------------------------

		move_uploaded_file($_FILES["doc"]["tmp_name"],$path);
		$result=mysql_query("UPDATE candidates SET identiPic='$path' WHERE loginName='$_SESSION[loginName]'",$con);

		$msg = "Your indentification photo has been saved!";
			
		mysql_close();
		@unlink($_FILES['doc']);
	}
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>