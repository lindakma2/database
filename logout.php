<?php
header("Content-Type:text/html; charset=utf-8");
//開啟Session
session_start();
//清除Session
session_destroy();
//導到
if (!empty($_SERVER['HTTP_REFERER']))
    header("Location: ".$_SERVER['HTTP_REFERER']);
?>