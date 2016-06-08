<?php
	session_start();
	header('Content-Type:text/html;charset=UTF-8;ContentType:application/json');
	$getStr = $_POST['postStr'];
	$de = json_decode($getStr,true);

	$con = mysql_connect('localhost','root','');
	if(!$con){
		die("Could not connect!" . mysql_error());
	}
	mysql_query("SET NAMES UTF8");
	mysql_select_db('account',$con);
	$result = mysql_query("UPDATE candidates SET describeSelf='$de[describe]',proof='$de[proof]',introduce='$de[introduce]'  
				WHERE studentNumber = '$de[studentNumber]'",$con);
	//------------------------------这里好奇怪，不能是describe！！！------------------------------------------
		if(!$result){	
			die("Error1: " . mysql_error());
		}
	$return = "信息已修改成功！";

	mysql_close();
	echo "$return";

?>