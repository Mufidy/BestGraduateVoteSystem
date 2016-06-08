<?php
	session_start();
	header('Content-Type:text/html;charset=UTF-8');
//提交信息
function flag_03(){

	$getStr = $_GET['postStr'];
	$de = json_decode($getStr,true);
	$return = "ERROR";

	$con = mysql_connect('localhost','root','');
	if(!$con){
		die("Could not connect!" . mysql_error());
	}
	mysql_query("SET NAMES UTF8");
	mysql_select_db('account',$con);

	$result = mysql_query("SELECT identiPic,lifePic FROM candidates WHERE loginName='$_SESSION[loginName]'",$con);
	$checkPic = mysql_fetch_row($result);
	if ($checkPic[0]==''||$checkPic[1]==''){
		$return = "请上传个人照片！";
	}
	else {

		//判断推荐类型
		$save = 'no';
		if ($de['recommend'] == '院系推荐'){
			$result = mysql_query("SELECT registed FROM code WHERE checkCode='$de[checkCode]'",$con);
			if (!$result){
				die("Error3: ".mysql_error());
			}

			$checkRes = mysql_fetch_row($result);
			//获取推荐码
			if ($checkRes==''){
				$return="请输入正确的校验码！";
			}
			else if($checkRes[0]=='f'){
				//验证码正确
				$result = mysql_query("UPDATE code SET registed='y',studentNumber='$de[studentNumber]' 
					WHERE checkCode='$de[checkCode]'",$con);
				if (!$result){
					die("Error4: ".mysql_error());
				}

				$save = 'ok';
			}
			else if ($checkRes[0]=='y'){
				$result = mysql_query("SELECT studentNumber FROM code WHERE checkCode='$de[checkCode]'",$con);
				if (!$result){
					die("Error3: ".mysql_error());
				}

				$check2_Res = mysql_fetch_row($result);
				//验证码正确
				
				if ($check2_Res[0]==$de['studentNumber'])
					$save = 'ok';
				else
					$return = "此验证码已经被注册！";
			}
		}
		if ($save == 'ok'||$de['recommend'] == '自我推荐'){
			$result = mysql_query("SELECT studentNumber,loginName FROM candidates WHERE studentNumber='$de[studentNumber]'");
			$retNumber = mysql_fetch_row($result);
			if (!$retNumber||$retNumber[1]==$_SESSION['loginName']){

				$result = mysql_query("UPDATE candidates SET name='$de[name]',sex='$de[sex]',studentNumber='$de[studentNumber]',political='$de[political]',
						nation='$de[nation]',telephone='$de[telephone]',college='$de[college]',email='$de[email]',seniorHighSchool='$de[seniorHighSchool]',publicOr='$de[publicOr]',
						style='$de[style]',describeSelf='$de[describe]',proof='$de[proof]',introduce='$de[introduce]',recommend='$de[recommend]',checkCode='$de[checkCode]' 
						WHERE loginName = '$_SESSION[loginName]'",$con);
			//------------------------------这里好奇怪，不能是describe！！！------------------------------------------
				if(!$result){	
					die("Error1: " . mysql_error());
				}
				$collegeArray = array(
					0=>'建筑学院',
					1=>'机械工程学院',
					2=>'能源与环境学院',
					3=>'信息科学与工程学院',
					4=>'土木工程学院',
					5=>'电子科学与工程学院',
					6=>'数学系',
					7=>'自动化学院',
					8=>'计算机科学与工程学院',
					9=>'物理系',
					10=>'生物科学与医学工程学院',
					11=>'材料科学与工程学院',
					12=>'人文学院',
					13=>'经济管理学院',
					14=>'电气工程学院',
					15=>'外国语学院',
					16=>'化学化工学院',
					17=>'交通学院',
					18=>'仪器科学与工程学院',
					19=>'艺术学院',
					20=>'法学院',
					21=>'学习科学研究中心',
					22=>'公共卫生学院',
					23=>'医学院',
					24=>'吴健雄学院',
					25=>'软件学院',
					26=>'无锡分校'
				);
				for ($i = 0;$i < 27;$i++){
					$result = mysql_query("UPDATE statistics SET amount=( SELECT COUNT(college) FROM candidates WHERE college='$collegeArray[$i]') WHERE college='$collegeArray[$i]'",$con);
					if (!$result){
						die("Error2: ".mysql_error());
					}
				}
				$return = "个人信息保存成功！";
			}
			else{

				$return = "此学号已注册！";
			}
		}

	}
	mysql_close();
	/*$ret = json_encode($return);*/
	echo "$return";
}
//管理员登录
function flag_04(){
	$loginName = $_REQUEST['adminName'];
	$password = $_REQUEST['adminPwd'];

	$return = 1;//默认用户名不存在
	$con = mysql_connect('localhost','root','');
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	//mysql_query("SET NAMES UTF8");
	mysql_select_db("account", $con);

	$info = "SELECT adminpwd FROM admin WHERE adminlogin = '$loginName'";
	$result = mysql_fetch_array(mysql_query($info,$con));
	
	if($result[0]){
		if( $password == $result[0] ){
		 	$return = "admin0322.html";//登录成功
		 }
		else
			$return = 3;//密码错误
	 }
	mysql_close($con);

	echo $return;
}
//学生登录
function flag_05(){
	$_SESSION['fruit'] = 'noo';
	$_SESSION['loginName'] = $_REQUEST['loginName'];
	$loginName = $_SESSION['loginName'];
	$password = $_REQUEST['password'];
	$getValidateNum = $_REQUEST['postValidateNum'];

	if ($getValidateNum == $_SESSION['validateNum']){
		$return = 1;//默认用户名不存在
		$con = mysql_connect('localhost','root','');
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		//mysql_query("SET NAMES UTF8");
		mysql_select_db("account", $con);

		$info = "SELECT password FROM Candidates WHERE loginName = '$loginName'";
		$result = mysql_fetch_array(mysql_query($info,$con));
		
		if($result[0]){
			if( $password == $result[0] ){
				$_SESSION['fruit'] = 'goo';//修改cookie值
			 	$return = "inde.html";//登录成功
			 }
			else
				$return = 3;//密码错误
		 }
		mysql_close($con);
	}
	else{
		$return = 2;//验证码错误
	}

	echo $return;
}
//注册
function flag_06(){
	$_SESSION['loginName'] = $_GET['loginName'];
	$password = $_GET['password'];

	$con = mysql_connect('localhost','root','');
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_query("SET NAMES UTF8");
	mysql_select_db("account", $con);

	$check = mysql_query("SELECT * FROM candidates WHERE loginName='$_SESSION[loginName]'",$con);
	if(!$check){
		die('Error 1: '.mysql_error());
	}
	else if(mysql_num_rows($check) > 0){
		$ret = 'false';
		$_SESSION['fruit'] = 'noo';
	}
	else{
		$write = "INSERT INTO candidates(loginName,password) VALUES ('$_SESSION[loginName]','$password')";
		if(!mysql_query($write,$con))
			die('Error2: '.mysql_error());
		$ret = 'inde.html';
		$_SESSION['fruit'] = 'goo';
	}
	mysql_close($con);
	//$ret = json_encode($result);
	echo $ret;
}

//管理员跳转
function flag_07(){
	$adminkey = $_REQUEST['adminkey'];
	$_SESSION['adminkey'] = $adminkey;
	$return = 3;//默认口令错误
	$con = mysql_connect('localhost','root','');
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	//mysql_query("SET NAMES UTF8");
	mysql_select_db("account", $con);

	$info = "SELECT adminkey FROM admin WHERE adminkey = '$adminkey'";
	$result = mysql_fetch_array(mysql_query($info,$con));
	
	if($result[0]){
		if( $adminkey == $result[0] ){
		 	$return = "adminlogin.html";//登录成功
		 }
	 }
	mysql_close($con);

	echo $return;
}

//管理员提交
function flag_08(){
	$getStr = $_GET['postStr'];
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
}

//-------------------------------------------------------------------------------------------
	$flag = $_REQUEST['flag'];
	if ($flag == '03'){
		flag_03();
	}
	else if ($flag == '04'){
		flag_04();
	}
	else if ($flag == '05'){
		flag_05();
	}
	else if ($flag == '06'){
		flag_06();
	}
	else if ($flag == '07'){
		flag_07();
	}
	else if ($flag == '08'){
		flag_08();
	}
?>