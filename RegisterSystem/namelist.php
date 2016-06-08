<?php
	session_start();
	header('Content-Type:text/html;charset=UTF-8');
	$college = $_GET['schoolname'];
	$college = json_decode($college,true);
	//$college = iconv("UTF-8","GB2312",$college);
	$college = $college['college'];
	$con = mysql_connect('localhost','root','');
	if (!$con){
		die("Could not connect!".mysql_error());
	}
	mysql_query("SET NAMES UTF8");
	mysql_select_db('account',$con);

	$total_1 = mysql_query("SELECT amount FROM statistics WHERE college='$college'",$con);
	if(!$total_1){
		die("Error1 :mysql query :".mysql_error());
	}
	$total_2 = mysql_fetch_array($total_1);
	$total = $total_2[0];

	$people = array();
	$people_1 = mysql_query("SELECT name,studentNumber FROM candidates WHERE college='$college'",$con);
	if (!$people_1) {
		die("Error2 :mysql query :".mysql_error());
	}
	while ($people_2 = mysql_fetch_assoc($people_1)){
		$who = array('sId' => $people_2['studentNumber'], 'sName' => urlencode($people_2['name']));
		array_push($people, $who);
	}	
	mysql_close();
	$json_return1 = array('total' => $total,'people' => $people);
	//$json_return = serialize($json_return1);
	$ret = json_encode($json_return1);
	$ret = urldecode($ret);
	echo "$ret";
?>	