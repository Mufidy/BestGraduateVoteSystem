<?php
	session_start();
	header('Content-Type:text/html;charset=UTF-8');

	function flag01(){
		$studentNumber = $_GET['studentId'];
		$con = mysql_connect('localhost','root','');
		if (!$con){
			die("Could not connect!".mysql_error());
		}
		mysql_query("SET NAMES UTF8");
		mysql_select_db('account',$con);

		$detailInfo_1 = mysql_query("SELECT name,studentNumber,nation,telephone,email,seniorHighSchool,
			sex,publicOr,college,political,style,describeSelf,proof,introduce,recommend,checkCode,identiPic,lifePic
			FROM candidates WHERE studentNumber='$studentNumber'",$con);
		if(!$detailInfo_1){
			die("Error in 01". mysql_error());
		}
		$detailInfo = mysql_fetch_row($detailInfo_1);
		$json_infoDet = array(
			"realname"=>$detailInfo[0],
			"number"=>$detailInfo[1],
			"nation"=>$detailInfo[2],
			"tele"=>$detailInfo[3],
			"email"=>$detailInfo[4],
			"highschool"=>$detailInfo[5],
			"sex"=>$detailInfo[6],
			"yesorno"=>$detailInfo[7],
			"college"=>$detailInfo[8],
			"politicallandscape"=>$detailInfo[9],
			"type"=>$detailInfo[10],
			"describe"=>$detailInfo[11],
			"material"=>$detailInfo[12],
			"introduce"=>$detailInfo[13],
			"recommend"=>$detailInfo[14],
			"checkCode"=>$detailInfo[15],
			"identiPic"=>$detailInfo[16],
			"lifePic"=>$detailInfo[17]
			);
		mysql_close();
		foreach ($json_infoDet as $key => $value) {
			$json_infoDet[$key] = urlencode($value);
		}
		//$json_return = serialize($json_infoDet);
		$ret = json_encode($json_infoDet);
		$ret = urldecode($ret);
		echo "$ret";
	}
	//_loadDet();加载选手个人信息
	function flag02(){
		$loginName = $_SESSION['loginName'];
		$con = mysql_connect('localhost','root','');
		if (!$con){
			die("Could not connect!".mysql_error());
		}
		mysql_query("SET NAMES UTF8");
		mysql_select_db('account',$con);

		$detailInfo_1 = mysql_query("SELECT name,studentNumber,nation,telephone,email,seniorHighSchool,
			sex,publicOr,college,political,style,describeSelf,proof,introduce,recommend,checkCode,identiPic,lifePic
			FROM candidates WHERE loginName='$loginName'",$con);
		if(!$detailInfo_1){
			die("Error in 02". mysql_error());
		}
		$detailInfo = mysql_fetch_row($detailInfo_1);
		$json_infoDet = array(
			"realname"=>$detailInfo[0],
			"number"=>$detailInfo[1],
			"nation"=>$detailInfo[2],
			"tele"=>$detailInfo[3],
			"email"=>$detailInfo[4],
			"highschool"=>$detailInfo[5],
			"sex"=>$detailInfo[6],
			"yesorno"=>$detailInfo[7],
			"college"=>$detailInfo[8],
			"politicallandscape"=>$detailInfo[9],
			"type"=>$detailInfo[10],
			"describe"=>$detailInfo[11],
			"material"=>$detailInfo[12],
			"introduce"=>$detailInfo[13],
			"recommend"=>$detailInfo[14],
			"checkCode"=>$detailInfo[15],
			"identiPic"=>$detailInfo[16],
			"lifePic"=>$detailInfo[17]
			);
		mysql_close();
		foreach ($json_infoDet as $key => $value) {
			$json_infoDet[$key] = urlencode($value);
		}
		//$json_return = serialize($json_infoDet);
		$ret = json_encode($json_infoDet);
		$ret = urldecode($ret);
		echo "$ret";
	}

	$flag = $_GET['flag'];
	
	if($flag == '01'){		
		flag01();
	}
	else if($flag == '02')
		flag02();
	else
		$ret = -1;
?>	