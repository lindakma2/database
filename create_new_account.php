<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>新增管理員帳號</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/create_new_account_style.css"/>   
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
                        header("Location: search_find.php");
                    }

                }
                else{
                    header("Location: search_find.php");
                }
            ?>
        </aside>
        <section>
            <div class="create_account"> <!--表單的部分 白底透明的區塊-->           
                <h2 class="page_title">新增管理員帳號</h2>         
                <form method="post" action="worker_catch.php" name="enter">
                    <input type="radio" id="identity" name="identity" value="boss" />職員/主管
                    <input type="radio" id="identity" name="identity" value="partime"/>工讀生<br><br>
                    <input type="text" name="name" id="name" placeholder="姓名" required/><br><br>
                    <input type="text" name="account" id="account" placeholder="帳號(學號或職編)" required/><br><br>
                    <input type="password" id="password" name="password" placeholder="密碼" required /><br><br>
                    <input type="password" id="confirm" name="confirm" placeholder="確認密碼" required/><br><br>
                    <input type="hidden" id="state" name="state" value="1">
                    <input type="submit" name="Increase" value="確認加入" onclick="getValueInput()"/><br><br>
                </form>
                <script> 
                    //判斷輸入內容
                    const getValueInput = () =>
                    {
                        let inputconfirm = document.getElementById("confirm").value; 
                        let inputname = document.getElementById("name").value;
                        let inputidentity = document.getElementById("identity").value;
                        let inputaccount = document.getElementById("account").value;
                        let inputpassword = document.getElementById("password").value;
                        if(inputpassword!=inputconfirm)
                        {
                            alert('密碼不符');
                            document.getElementById('state').value = '0';
                        }
                        if(inputname=='')
                        {
                            document.getElementById('state').value = '0';
                        }
                        if(inputidentity=='')
                        {
                            document.getElementById('state').value = '0';
                        }
                        if(inputaccount=='')
                        {
                            document.getElementById('state').value = '0';
                        }
                    }   
                </script> 
            </div><!--表單部分結束-->  
        </section> 
    </div>
    </body>
</html>