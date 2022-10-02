<?php
session_start();
$id=$_SESSION['id'];
if(isset($_POST['Update']))
{
        $state=date('Y-m-d');
        $getname=$_POST['getname'];
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                mysqli_select_db($link,"失物招領系統");
                $sql="UPDATE findthing SET getname='$getname',returntime='$state',stateid=2 WHERE findthingid='$id'";
                mysqli_query($link,'SET NAMES utf8');
                mysqli_query($link,$sql);
        echo '<script>window.alert("更新成功!");window.location.href=\'search_find.php\';</script>';
}
?>