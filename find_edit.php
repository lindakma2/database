<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>狀態更新</title>
<link rel="stylesheet" href="css/find_edit.css"/>
<link rel="stylesheet" href="css/style.css"/>
</head>
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
            <div class="find_edit"> <!--表單的部分 白底透明的區塊-->           
                <h2 class="page_title">更新拾獲物領取者</h2>
                <?php
                    $id=$_GET['id'];
                    $_SESSION['id']=$id;
                    $name=$_SESSION['name'];
                    $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                    mysqli_select_db($link,"失物招領系統");
                    $sql="SELECT findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,findthing.findrecacc,findthing.getrecacc,findthing.returntime FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid";
                    mysqli_query($link,'SET NAMES utf8');
                    $sql="UPDATE findthing SET getrecacc='$name'WHERE findthingid='$id'";
                    mysqli_query($link,'SET NAMES utf8');
                    mysqli_query($link,$sql);   
                ?>     
                <form method="post" action="find_edit_value.php" name="enter">
                <p>領取者: </p><input type="text" id="getname" name="getname" />
                <input type="hidden" id="state" name="state" value="1">
                <input type="submit" name="Update" value="更新"/>
                </form>
            </div><!--表單部分結束-->  
    </section>
    <script> 
        //判斷輸入內容
        let today = new Date();
        document.getElementById('state').value = today;
        //alert(today);
    </script>
</html>