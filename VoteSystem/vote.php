<?php
//投票后台
session_start();
header('Content-Type:text/html;charset=UTF-8');

date_default_timezone_set('prc');
$my_t=getdate(date("U"));
$check_h = $my_t['hours'];

$return = 2;//默认为未登录状态
$getValidateNum = $_REQUEST['postValidateNum'];
$getValidateNum = strtolower($getValidateNum);
$getVoteArray = $_REQUEST['voteArray'];
$getVoteArray = json_decode($getVoteArray,true);
$voteFor = $getVoteArray;//这是该用户选择的人组成的数组
$voteFor = array_unique($voteFor);
$voteTotal = count($voteFor);


if(!isset($_SESSION['loginName'])){
	$return = 2;
	echo $return;
}
else{
	if($check_h>=8 && $check_h<=22){
		if (true) {
			//判断 是前台数据
			if ($getValidateNum == $_SESSION['validateNum']) {
				
				if ($voteTotal == 15) {

					//下面根据该用户名去数据库查是否已经投过票
					$loginName = $_SESSION['loginName'];
					$type = $_SESSION['type'];
					$con = mysql_connect('localhost','root','');
					if (!$con){
						die("Could not connect!".mysql_error());
					}
					mysql_query("SET NAMES UTF8");
					mysql_select_db('vote',$con);
					$db_table = "users_".$type;
					$checked_1 = mysql_query("SELECT voted FROM $db_table WHERE loginName='$loginName'",$con);
					if(!$checked_1){
						die("Error in 02". mysql_error());
					}
					$checked = mysql_fetch_row($checked_1);
					
					if ($checked[0] == 1) {
						//该用户已经投票;
						$return = 4;
						echo $return;
					} else {
						//下面将投票信息写入数据库
						$voteForStr = " ";
						for ($i=0; $i < $voteTotal; $i++) { 
							$voteForStr = $voteForStr." ".$voteFor[$i];//这里讲数组转化为字符串
						}
						//1.更新候选者数据库
						$polls = "polls_".$type;
						for ($i=0; $i < $voteTotal; $i++) {
							//先找出选手当下的得票情况
							$voteTempId = $voteFor[$i];
							$getCC = mysql_query("SELECT $polls FROM candidates WHERE studentNumber='$voteTempId'",$con);
							if(!$getCC){
								die("Error in 02". mysql_error());
							}
							$getCCINT = mysql_fetch_row($getCC);
							$nowPoll = $getCCINT[0] +1;
							//下面更新使票数+1
							$result = mysql_query("UPDATE candidates SET $polls='$nowPoll' WHERE studentNumber='$voteTempId'",$con);
							if (!$result){
								die("Error2: ".mysql_error());
							}
						}
						
						//2.更新用户数据库，将其已投票信息写入
						$result = mysql_query("UPDATE $db_table SET voted=1,voteFor='$voteForStr'  WHERE loginName = '$loginName'",$con);
						if(!$result){	
							die("Error1: " . mysql_error());
						}
						
						//下面为日志记录
						$currentTime = $my_t['year']."-".$my_t['mon']."-".$my_t['mday']." ".$my_t['hours'].":".$my_t['minutes'].":".$my_t['seconds']." ";
						$rinfo=$_SESSION['loginName']." ".$currentTime.'VOTE FOR: '.$voteFor[0]." ".$voteFor[1]." ".$voteFor[2]." ".$voteFor[3]." ".$voteFor[4]." ".$voteFor[5]." ".$voteFor[6]." ".$voteFor[7]." ".$voteFor[8]." ".$voteFor[9]." ".$voteFor[10]." ".$voteFor[11]." ".$voteFor[12]." ".$voteFor[13]." ".$voteFor[14]." ";//php写文本的内容
						$keydb ="voteLog.txt";//php写文本保存的文件名
						$fp=fopen($keydb,"a");//写入方法
						fwrite($fp,$rinfo."\r\n\r\n"); //写入数据
						fclose($fp);
						$return = 1;
						echo $return;
					}//end of 是否已经投过票
					
				} else {
					$return = 5;
					echo $return;
				}//end of 判断人数是否正确
				
			} else {
				$return = 6;
				echo $return;
			}//end of 判断验证码
		} else {
			$return = 3;
			echo $return;
		}//end of 是否前台
	} else {
		$return = 7;
		echo $return;
	}//end of time
}//end of 是否已经登陆


?>