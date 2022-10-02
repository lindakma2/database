<?php
session_start();

$findthingid=$_SESSION["findthingid"];
$name=$_FILES["file"]["name"];
$find="find$findthingid$name";
move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$find);
$link= @mysqli_connect("localhost","root","")or die("無法開啟");
    mysqli_select_db($link,"失物招領系統");

$sql="UPDATE findthing set photoname='$find' WHERE findthingid='$findthingid'";
    mysqli_query($link,'SET NAMES utf8');
    mysqli_query($link,$sql);
    echo '<script>window.alert("上傳成功!");window.location.href=\'search_find.php\';</script>';
?>