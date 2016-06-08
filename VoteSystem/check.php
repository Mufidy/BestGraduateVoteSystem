<?php
date_default_timezone_set('prc');
$my_t=getdate(date("U"));
$check_h = $my_t['hours'];
$ret ='x';
if ($check_h>=8 && $check_h<=22) {
	//可以投票！
} else {
	$ret = "cannot.html";
}
echo $ret;
?>