<?php
//校外注册使用
session_start();
header('Content-Type:text/html;charset=UTF-8');
$return = 2;//默认为错误值

$judge = $_POST['refere'];
if ($judge=="reference1") {
	# code...
	canRegister();
} else {
	# code...
	//不是从前台发来的注册信息，驳回！
	$return = 3;
	echo $return;
}

function canRegister(){
	$_SESSION['loginName'] = $_POST['loginName'];
	$_SESSION['type'] = "out";
	$password = $_POST['password'];
	/*后台判断用户名和密码是否均为6-12位的字母和数字组合，防止注入，先判断用户名*/
	if (!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)([.])([0-9a-zA-Z]{2,4})",$_SESSION['loginName'])) {
		# code...
		//用户名不符合规定
		$return = 4;
		echo $return;
	} else {
		# code...
		/*后台再判断密码是否符合规定*/
		if (!preg_match("/^[a-z\d]{6,15}$/i",$password)) {
			# code...
			//密码不符合规定
			$return = 5;
			echo $return;
		} else {
			# code...
			//下面往数据可写入注册信息
			$con = mysql_connect('localhost','root','');
			if(!$con){
				die("Could not connect!" . mysql_error());
			}
			mysql_query("SET NAMES UTF8");
			mysql_select_db('vote',$con);
			$check = mysql_query("SELECT * FROM users_out WHERE loginName='$_SESSION[loginName]'",$con);
			if (!$check) {
				# code...
				die('Error 1: '.mysql_error());
			} else if(mysql_num_rows($check) > 0){
				# code...
				//用户名已经存在
				$return = 6;
				echo $return;
			} else {
				$write = "INSERT INTO users_out(loginName,password) VALUES ('$_SESSION[loginName]','$password')";
				if(!mysql_query($write,$con))
					die('Error2: '.mysql_error());
				$return = 1;//注册成功
				echo $return;
			}
			mysql_close($con);
		}	
	}		
}

?>