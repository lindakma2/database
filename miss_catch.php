<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Ch11_1_1.php</title>
</head>
<body>
<?php
//確認判斷均無誤再進行抓取
$misschnum=$_POST['misschnum'];
$outlook=$_POST['outlook'];
$kindid=$_POST['kindid'];
$daytime=$_POST['daytime'];
$placeid=$_POST['placeid'];
//將資料內容抓進資料庫
if(isset($_POST['Register']))
{
	$link= @mysqli_connect("localhost","root","")or die("無法開啟");
  	mysqli_select_db($link,"失物招領系統");
  	if(!$link)
	{
		echo "error";
	}
  	$sql="INSERT INTO misthing (misthingid,misschnum,daytime,outlook,kindid,placeid,stateid,photoname) VALUES ('','$misschnum','$daytime','$outlook','$kindid','$placeid','4','')";
  	//echo "<script>alert(\"$sql\")</script>";
	mysqli_query($link,'set names utf8');
   	mysqli_query($link,$sql);
}
echo '<script>window.alert("新增成功!");window.location.href=\'miss_rigster.php\';</script>';
?>
</body>
</html>