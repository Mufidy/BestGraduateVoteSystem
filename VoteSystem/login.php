<?php
//登陆用，校内校外均可
session_start();
header('Content-Type:text/html;charset=UTF-8');
$return = 5;//默认为用户名不存在

$judge = $_POST['refere'];
if ($judge=="reference2") {
	# code...
	canLogin();
} else {
	# code...
	//不是从前台发来的注册信息，驳回！
	$return = 3;
	echo $return;
}

function canLogin(){
	$loginName = $_REQUEST['loginName'];
	$password = $_REQUEST['password'];
	$type = $_REQUEST['type'];
	$getValidateNum = $_REQUEST['postValidateNum'];
	$getValidateNum = strtolower($getValidateNum);

	if ($getValidateNum == $_SESSION['validateNum']) {
		if( $type == "out"){
			if (ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)([.])([0-9a-zA-Z]{2,4})",$loginName) && preg_match("/^[a-z\d]{6,12}$/i",$password)) {
				# code...
				$con = mysql_connect('localhost','root','');
				if (!$con){
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("vote", $con);
				
				if ($type == "in") {
					//校内用户
					$info = "SELECT password FROM users_in WHERE loginName = '$loginName'";
					$result = mysql_fetch_array(mysql_query($info,$con));

					if ($result[0]) {
						if( $password == $result[0] ){
							$return = 1;//登陆成功
							$_SESSION['loginName'] = $loginName;
							$_SESSION['type'] = $type;
							echo $return;
						 }
						else{
							$return = 4;//密码错误
							echo $return;
						}
					}

				} else if($type == "out") {
					//校外用户
					$info = "SELECT password FROM users_out WHERE loginName = '$loginName'";
					$result = mysql_fetch_array(mysql_query($info,$con));

					if ($result[0]) {
						if( $password == $result[0] ){
							$return = 1;//登陆成功
							$_SESSION['loginName']=$loginName;
							$_SESSION['type']=$type;
							echo $return;
						 }
						else{
							$return = 4;//密码错误
							echo $return;
						}
					}

				}
				mysql_close($con);
			} else {
				$return = 6;
				echo $return;
			}
		} else if ($type=="in") {
			if (preg_match("/^[a-z\d]{6,12}$/i",$loginName) && preg_match("/^[a-z\d]{6,12}$/i",$password)) {
				# code...
				$con = mysql_connect('localhost','root','');
				if (!$con){
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("vote", $con);
				
				if ($type == "in") {
					//校内用户
					$info = "SELECT password FROM users_in WHERE loginName = '$loginName'";
					$result = mysql_fetch_array(mysql_query($info,$con));

					if ($result[0]) {
						if( $password == $result[0] ){
							$return = 1;//登陆成功
							$_SESSION['loginName'] = $loginName;
							$_SESSION['type'] = $type;
							echo $return;
						 }
						else{
							$return = 4;//密码错误
							echo $return;
						}
					}

				} else if($type == "out") {
					//校外用户
					$info = "SELECT password FROM users_out WHERE loginName = '$loginName'";
					$result = mysql_fetch_array(mysql_query($info,$con));

					if ($result[0]) {
						if( $password == $result[0] ){
							$return = 1;//登陆成功
							$_SESSION['loginName']=$loginName;
							$_SESSION['type']=$type;
							echo $return;
						 }
						else{
							$return = 4;//密码错误
							echo $return;
						}
					}

				}
				mysql_close($con);
			} else {
				$return = 6;
				echo $return;
			}
		}//in
	} else {
		$return = 2;//验证码错误
		echo $return;
	}
}

?>