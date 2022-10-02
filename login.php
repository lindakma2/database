<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>login.php</title>
   </head>
   
   <body>
      <?php
      session_start();  // 啟用交談期
      $account = "";  $password = "";
      // 取得表單欄位值
      if ( isset($_POST["account"]) )
         $account = $_POST["account"];
      if ( isset($_POST["password"]) )
         $password = $_POST["password"];
      // 檢查是否輸入使用者名稱和密碼
      if ($account != "" && $password != "") {
         // 建立MySQL的資料庫連接 
         $link= @mysqli_connect("localhost","root","")or die("無法開啟");
         mysqli_select_db($link,"失物招領系統");
         //connect to database
         
         //送出UTF8編碼的MySQL指令
         mysqli_query($link, 'SET NAMES utf8');
         //select table from "students"
         
         // 建立SQL指令字串
         $sql="SELECT * FROM worker";
         if($result=mysqli_query($link,$sql))
         {
                  $flag=FALSE;
                  while ($row=mysqli_fetch_assoc($result)) 
                  {
                           if($row["account"]==$account&&$row["password"]==$password)
                           {
                                 $_SESSION["name"]=$row["account"];
                                 $_SESSION["check"]=true;
                                 $_SESSION["identity"]=$row["identity"];   //我新加的
                                 $_SESSION["stop"]=$row["stopauthority"];
                           }
                  }
         }

         // 執行SQL查詢
         $result = mysqli_query($link, $sql);
         $total_records = mysqli_num_rows($result);

         // 是否有查詢到使用者記錄
         if ( $total_records > 0 && $_SESSION["stop"] != 1) {
            // 成功登入, 指定Session變數
            echo '<script>window.alert("'.$row["stopauthority"].'")</script>';
            $_SESSION["login_session"] = true;
            if (!empty($_SERVER['HTTP_REFERER']))
               header("Location: ".$_SERVER['HTTP_REFERER']);
         }
         else {  // 登入失敗
            echo '<script>window.alert("帳號密碼錯誤，請重新登入!")</script>';
            if (!empty($_SERVER['HTTP_REFERER']))
               header("Location: ".$_SERVER['HTTP_REFERER']);
         }
         // 關閉資料庫連接
         mysqli_close($link);
      }
      ?>
   </body>
</html>