<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>管理員帳號停權</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/stop_authority.css"/>   
    </head>
    <body>
        <section>
            <h1 class="page_title">國立台南大學拾獲物及遺失物管理系統</h1>
        </section>
        <div>
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
                }
                else{
                    header("Location: search_find.php");
                }
            ?>
        </aside>
            <section>
                <div class="stop_authority"> <!--表單的部分 白底透明的區塊-->           
                    <h2 class="page_title">管理員帳號停權</h2>         
                    <hr/><br/>
                    <table><!--管理員帳號的欄位標題-->
                    <tr>                       
                        <th>帳號</th>
                        <th>名字</th>
                        <th>身分別</th>
                        <th>編輯</th>                  
                        </tr>
                        <?php
                            $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                    mysqli_select_db($link,"失物招領系統");
                                    $sql="SELECT * from worker";
                                    mysqli_query($link,'SET NAMES utf8');
                                    if($result=mysqli_query($link,$sql))
                                    {
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr><td>".$row["account"]."</td>
                                                        <td>".$row["name"]."</td>
                                                        <td>".$row["identity"]."</td>";
                                            if($row["stopauthority"] == 1){
                                                echo "<td><a href='authority_edit.php?action=reuse&id=".$row["account"]."'><b>恢復</b></td></tr>";
                                            }
                                            else{
                                                echo "<td><a href='authority_edit.php?action=stop&id=".$row["account"]."'><b>停權</b></td>";           
                                            }
                                        }
                                    }
                                    //echo "<script>alert(\"$sql\")</script>";
                                    mysqli_query($link,$sql);
                        ?>          
                    </table>
                </div><!--表單部分結束-->  
            </section>
        </div>
    </body>
</html>