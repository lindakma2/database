<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>上傳遺失物照片</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/find_file_increase.css"/>   
    </head>
    <body>
        <section>
            <h1 class="page_title">國立台南大學拾獲物及遺失物管理系統</h1>
        </section>
        <aside>
            <?php
                session_start();
                if(isset($_SESSION["login_session"])){
                    if($_SESSION["login_session"]){
                        echo'
                            <p style="margin-left: 40px;">您好!</p>
                            <br>
                            <a href="search_find.php" target="_self">拾獲物管理</a><br>
                            <a href="miss_rigster.php" target="_self">遺失物管理</a><br>';
                        if($_SESSION["identity"]=="boss")
                        {
                            echo'
                                <a href="stop_authority.php" target="_self">管理員帳號停權</a><br>
                                <a href="create_new_account.php" target="_self">加入新帳號</a>';
                        }
                        echo'
                            <form method="post" action="logout.php" name="enter"><br>
                            <input type="submit" name="Logout" value="登出"/>
                            </form>';
                    }
                    else{
                        echo "<script>alert('帳號密碼錯誤，請重新登入!')</script>";
                        echo '
                        <p style="margin-left: 40px;">管理員登入</p>
                        <form method="post" action="login.php" name="enter">
                        <input type="text" id="account" name="account" placeholder="帳號(學號或職編)" required/><br/><br/>
                        <input type="password" id="password" name="password" placeholder="密碼" required/><br/><br/>
                        <input type="submit" name="Login" style="margin-left: 65px;" value="登入"/>
                        </form>';
                    }

                }
                else{
                    echo '
                        <p style="margin-left: 40px;">管理員登入</p>
                        <form method="post" action="login.php" name="enter">
                        <input type="text" id="account" name="account" placeholder="帳號(學號或職編)" required/><br/><br/>
                        <input type="password" id="password" name="password" placeholder="密碼" required/><br/><br/>
                        <input type="submit" name="Login" style="margin-left: 65px;" value="登入"/>
                        </form>';
                }
            ?>
        </aside>
        <section>
            <div class="find_file_increase"> <!--表單的部分 白底透明的區塊-->           
                <h2 class="page_title">上傳遺失物照片</h2>         
                <form action="miss_file_upload.php" method="post" enctype="multipart/form-data">
                    <p>檔案名稱:</p><input type="file" name="file" id="file" />
                    <input type="submit" name="submit" value="上傳檔案" />
                </form>
                <?php
                    $misthingid=$_GET['id'];
                    $_SESSION['misthingid']=$misthingid;
                ?>
            </div><!--表單部分結束-->  
        </section>
    </div>
    </body>
</html>