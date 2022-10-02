<?php
$id=$_GET["id"];
$action=$_GET["action"];
$link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        switch($action)
        {
                case "find":
                        $sql="UPDATE misthing SET stateid='5' WHERE misthingid='$id'";
                        mysqli_query($link,'SET NAMES utf8');
                        mysqli_query($link,$sql);
                        break;
                case "miss":
                        $sql="UPDATE misthing SET stateid='4' WHERE misthingid='$id'";
                        mysqli_query($link,'SET NAMES utf8');
                        mysqli_query($link,$sql);
                        break;
        }
       header("Location:miss_rigster.php");
?>