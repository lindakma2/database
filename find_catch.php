<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Ch11_1_1.php</title>
</head>
<body>
<?php
session_start();
//確認判斷均無誤再進行抓取
$pickname=$_POST['pickname'];
$outlook=$_POST['outlook'];
$kindid=$_POST['kindid'];
$daytime=$_POST['daytime'];
$placeid=$_POST['placeid'];
//將資料內容抓進資料庫
if(isset($_POST['Register'])&&$_SESSION["check"]==true)
{
	$findrecacc=$_SESSION['name'];
	$link= @mysqli_connect("localhost","root","")or die("無法開啟");
  	mysqli_select_db($link,"失物招領系統");
  	if(!$link)
	{
		echo "error";
	}
  	$sql="INSERT INTO findthing (findthingid,pickname,getname,findrecacc,rectime,outlook,kindid,placeid,getrecacc,stateid,returntime,photoname) VALUES ('','$pickname','','$findrecacc','$daytime','$outlook','$kindid','$placeid','','1','','')";
  	//echo "<script>alert(\"$sql\")</script>";
	mysqli_query($link,'set names utf8');
   	mysqli_query($link,$sql);
}
echo '<script>window.alert("新增成功!");window.location.href=\'search_find.php\';</script>';
?>
</body>
</html>