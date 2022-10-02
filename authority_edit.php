<?php
$id=$_GET["id"];
$action=$_GET["action"];
$link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        switch($action)
        {
        	case "stop":
                        $sql="UPDATE worker SET stopauthority='1' WHERE account='$id'";
                        mysqli_query($link,'SET NAMES utf8');
                        mysqli_query($link,$sql);
                        break;
                case "reuse":
                        $sql="UPDATE worker SET stopauthority='0' WHERE account='$id'";
                        mysqli_query($link,'SET NAMES utf8');
                        mysqli_query($link,$sql);
                        break;
        }
        header("Location:stop_authority.php");
?>

