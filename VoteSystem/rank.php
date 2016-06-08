<?php
//查询排名情况
session_start();
header('Content-Type:text/html;charset=UTF-8');
date_default_timezone_set('prc');
$my_t=getdate(date("U"));

$judge = $_POST['refere'];
if ($judge=="reference4") {
	# code...
	returnRanking();
} else {
	# code...	
	//不是从前台发来的注册信息，驳回！
	$return = 3;
	echo $return;
}

function returnRanking(){
	$loginName = $_SESSION['loginName'];
	$type = $_SESSION['type'];
	$type_look = $_REQUEST['typeX'];
	$con = mysql_connect('localhost','root','');
	if (!$con){
		die("Could not connect!".mysql_error());
	}
	mysql_query("SET NAMES UTF8");
	mysql_select_db('vote',$con);

	//首先判断这个娃娃有没有投票
	$db_table = 'users_'.$type;
	$polls = "polls_".$type_look;
	$checked_1 = mysql_query("SELECT voted FROM $db_table WHERE loginName='$loginName'",$con);
	if(!$checked_1){
		die("Error in 02". mysql_error());
	}
	$checked = mysql_fetch_row($checked_1);
	if ($checked[0] == 1) {
		//该用户投票了，去数据库找选手得票情况
		$findMax = mysql_query("SELECT $polls  FROM candidates WHERE $polls=(SELECT max($polls) FROM candidates) ",$con);
		if (!$findMax) {die("ERROR in max".mysql_errno());}
		$row_max=mysql_fetch_array($findMax);
		$maxPoll = $row_max[0];//找到最大值
		$pollDet_1 = mysql_query("SELECT name,studentNumber,$polls FROM candidates ORDER BY studentNumber ASC",$con);
		if(!$pollDet_1){
			die("Error in 01". mysql_error());
		}
		
		//声明1个数组，存储姓名，学号，票数
		$people = array();

		while ($pollDet = mysql_fetch_assoc($pollDet_1)) {
			$who = array('nameA' => urlencode($pollDet['name']), 'numberA' => $pollDet['studentNumber'], 'pollA' => $pollDet["$polls"]);
			array_push($people, $who);
		}
		$jsonReturn = array('people'=>$people,'maxPoll'=>$maxPoll);
		$ret = json_encode($jsonReturn);
		$return = urldecode($ret);
		echo $return;
	} else {
		//这孩子还没投票呢！
		$return = 2;
		echo $return;
	}
	mysql_close();
}

$currentTime = $my_t['year']."-".$my_t['mon']."-".$my_t['mday']." ".$my_t['hours'].":".$my_t['minutes'].":".$my_t['seconds']." ";
$rinfo=$_SESSION['loginName']." ".$currentTime.'查看了排名情况';//php写文本的内容
$keydb ="voteLog.txt";//php写文本保存的文件名
$fp=fopen($keydb,"a");//写入方法
fwrite($fp,$rinfo."\r\n"); //写入数据
fclose($fp);

?>