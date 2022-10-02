<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>遺失物登記、查詢頁面</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/miss_rigster.css"/>   
        <!-- Js 放大Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery.barfiller.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>  
    </head>
    <body>
        <section>
            <h1 class="page_title">國立台南大學拾獲物及遺失物管理系統</h1>
            <h1 class="page_title">遺失物登記、查詢</h1>
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
                        </form><br>
                        <a href="search_find.php" target="_self">拾獲物查詢</a><br>
                        <a href="miss_rigster.php" target="_self">遺失物登記</a><br>';
                    }

                }
                else{
                    echo '
                        <p style="margin-left: 40px;">管理員登入</p>
                        <form method="post" action="login.php" name="enter">
                        <input type="text" id="account" name="account" placeholder="帳號(學號或職編)" required/><br/><br/>
                        <input type="password" id="password" name="password" placeholder="密碼" required/><br/><br/>
                        <input type="submit" name="Login" style="margin-left: 65px;" value="登入"/>
                        </form><br>
                        <a href="search_find.php" target="_self">拾獲物查詢</a><br>
                        <a href="miss_rigster.php" target="_self">遺失物登記</a><br>';
                }
            ?>
        </aside>
        <section>           
            <div class="miss_rigster"> <!--選擇查詢條件的部分 白底透明的區塊-->         
                <p>遺失物登記: </p>
                <form method="post" action="miss_catch.php" name="enter">
                <p>遺失者學號:</p>
                <input type="text" id="misschnum" name="misschnum" />
                <p>物品外觀描述:</p>
                <input type="text" id="outlook" name="outlook" />
                <p>失物分類:</p>
                <select name="kindid">
                        <option value="1">3c用品類</option>
                        <option value="2">衣服鞋子</option>
                        <option value="3">書本文具</option>
                        <option value="4">包包配件</option>
                        <option value="5">證件類</option>
                        <option value="6">雨具</option>
                        <option value="7">水壺</option>
                        <option value="8">其他</option>
                </select><br/>
                <p>失物日期:</p>
                <input type="date" name="daytime" /><br/>
                <p>遺失地點:</p>
                <select name="section" id="section" onChange="change_building(this.selectedIndex);">
                    <option value="">請選擇校區</option> <!--12/11加-->
                    <option value='1'>校本部</option>
                    <option value='2'>榮譽校區</option>
                </select> 
                <select name="building" id="building" onChange="change_place(this.selectedIndex);">
                    <option value="">請先選擇校區</option>
                </select>
                <select name="placeid" id="placeid" >
                    <option value="">請先選擇校區和建築物</option>
                </select>
                <input type="submit" name="Register" value="登記" />
                </form>
            </div>
            <div class="miss_rigster">
                <form method="post" name="enter1"> <!--12/11 name改成enter1, 不然和上面重複-->
                <p>遺失物查詢:</p><br> <!--整個form 12/15改為做ERD報告時說的那樣(改為可勾選查詢方式並新增兩個條件)-->

                <input type="checkbox" name="checkbox" value="checkbox">
                <p>學號</p>
                <input type="text" id="misschnum" name="misschnum" /><br/>

                <input type="checkbox" name="checkbox" value="checkbox">
                <p>物品分類:</p>
                <select name="kindid">
                        <option value="1">3c用品類</option>
                        <option value="2">衣服鞋子</option>
                        <option value="3">書本文具</option>
                        <option value="4">包包配件</option>
                        <option value="5">證件類</option>
                        <option value="6">雨具</option>
                        <option value="7">水壺</option>
                        <option value="8">其他</option>
                </select>

                <input type="checkbox" name="checkbox" value="checkbox">
                <p>遺失日期:</p>
                <input type="date" id="searchdaytime" name="searchdaytime" />

                <input type="hidden" id="sql" name="sql" value="0">
                <input type="submit" name="Index" value="查詢" onclick="doOutput()"/>
                <input type="submit" name="All" value="全部列表" />
                </form>

                <script> 
                    //判斷輸入內容
                    let today = new Date();
                    document.getElementById('state').value = today;
                    function doOutput()
                    {
                        var obj=document.getElementsByName("checkbox");
                        var len = obj.length;
                        var checked = false;
                        if (obj[0].checked == true && obj[1].checked == true && obj[2].checked == true)
                        {
                            document.getElementById('sql').value = "1";
                        }
                        else if(obj[0].checked == true && obj[1].checked == true)
                        {
                            document.getElementById('sql').value = "2";
                        }
                        else if(obj[1].checked == true && obj[2].checked == true)
                        {
                            document.getElementById('sql').value = "3";
                        }
                        else if(obj[0].checked == true && obj[2].checked == true)
                        {
                            document.getElementById('sql').value = "4";
                        }
                        else if(obj[0].checked == true)
                        {
                            document.getElementById('sql').value = "5";
                        }
                        else if(obj[1].checked == true)
                        {
                            document.getElementById('sql').value = "6";
                        }
                        else if(obj[2].checked == true)
                        {
                            document.getElementById('sql').value = "7";
                        }
                        else
                        {
                            document.getElementById('sql').value = "8";
                        }
                    };  
                </script>
                <hr/>

                <table><!--搜尋結果的欄位標題-->
                    <?php
                        //for管理員
                        if(isset($_SESSION["login_session"])){
                            if($_SESSION["login_session"]){
                                echo'<tr style="font-size: 14px;">                       
                                    <th>遺失者</th>
                                    <th>遺失時間</th> 
                                    <th>物品外觀</th>
                                    <th>遺失地點</th>
                                    <th>遺失建築</th>
                                    <th>遺失校區</th>
                                    <th>物品種類</th>
                                    <th>物品狀態</th>                       
                                    <th>照片</th>
                                    <th>編輯</th>
                                    </tr>';
                            }
                        }
                        //for使用者
                        else{
                            echo'<tr style="font-size: 14px;">                       
                                    <th>遺失者</th>
                                    <th>遺失時間</th> 
                                    <th>物品外觀</th>
                                    <th>遺失地點</th>
                                    <th>遺失建築</th>
                                    <th>遺失校區</th>
                                    <th>物品種類</th>
                                    <th>物品狀態</th>                       
                                    <th>照片</th>
                                    </tr>';
                        }
                    ?>
                    <?php
                        //for管理員
                        if(isset($_SESSION["login_session"])){
                            if($_SESSION["login_session"]){
                                if(isset($_POST['Index']))
                                {
                                        $sqlstate=$_POST['sql'];
                                        $kindid=$_POST["kindid"];
                                        $searchdaytime=$_POST["searchdaytime"];
                                        $misschnum=$_POST['misschnum'];
                                        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                    mysqli_select_db($link,"失物招領系統");

                                    if($sqlstate==1)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.misschnum='$misschnum' AND misthing.rectime='$searchdaytime'";
                                        }
                                        else if($sqlstate==2)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.misschnum='$misschnum'";
                                        }
                                        else if($sqlstate==3)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.rectime='$searchdaytime'";
                                        }
                                        else if($sqlstate==4)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE  misthing.misschnum='$misschnum' AND misthing.rectime='$searchdaytime'";
                                        }
                                        else if($sqlstate==5)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.misschnum='$misschnum' ";
                                        }
                                        else if($sqlstate==6)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid'";
                                        }
                                        else if($sqlstate==7)
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.rectime='$searchdaytime'";
                                        }
                                        else
                                        {
                                                $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                        }
                                        //echo "<script>alert(\"$sql\")</script>";
                                    mysqli_query($link,'SET NAMES utf8');
                                    if($result=mysqli_query($link,$sql))
                                    {
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr><td>".$row["misschnum"]."</td>
                                                        <td>".$row["daytime"]."</td>
                                                        <td>".$row["outlook"]."</td>
                                                        <td>".$row["placename"]."</td>
                                                        <td>".$row["buildname"]."</td>
                                                        <td>".$row["sectionname"]."</td>
                                                        <td>".$row["kindname"]."</td>
                                                        <td>".$row["statename"]."</td>";
                                            if($row["photoname"]){
                                                echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                            }
                                            else{
                                                echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                            }
                                            if($row["stateid"] == 4){
                                                echo "<td><a href='miss_edit.php?action=find&id=".$row["misthingid"]."'><b>已尋獲</b></td></tr>";
                                            }
                                            else if($row["stateid"] == 5){
                                                echo "<td><a href='miss_edit.php?action=miss&id=".$row["misthingid"]."'><b>遺失中</b></td></tr>";
                                            }
                                        }
                                    }
                                    
                                    mysqli_query($link,'set names utf8');
                                    mysqli_query($link,$sql);
                                }
                                else if(isset($_POST['All']))
                                {
                                    $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                    mysqli_select_db($link,"失物招領系統");
                                    $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                    mysqli_query($link,'SET NAMES utf8');
                                    if($result=mysqli_query($link,$sql))
                                    {
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr><td>".$row["misschnum"]."</td>
                                                    <td>".$row["daytime"]."</td>
                                                    <td>".$row["outlook"]."</td>
                                                    <td>".$row["placename"]."</td>
                                                    <td>".$row["buildname"]."</td>
                                                    <td>".$row["sectionname"]."</td>
                                                    <td>".$row["kindname"]."</td>
                                                    <td>".$row["statename"]."</td>";
                                            if($row["photoname"]){
                                                echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                            }
                                            else{
                                                echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                            }
                                            if($row["stateid"] == 4){
                                                echo "<td><a href='miss_edit.php?action=find&id=".$row["misthingid"]."'><b>已尋獲</b></td></tr>";
                                            }
                                            else if($row["stateid"] == 5){
                                                echo "<td><a href='miss_edit.php?action=miss&id=".$row["misthingid"]."'><b>遺失中</b></td></tr>";
                                            }
                                        }
                                    }
                                    //echo "<script>alert(\"$sql\")</script>";
                                    mysqli_query($link,'set names utf8');
                                    mysqli_query($link,$sql); 
                                }
                                else
                                {
                                    $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                    mysqli_select_db($link,"失物招領系統");
                                    $sql="SELECT misthing.stateid,misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                    mysqli_query($link,'SET NAMES utf8');
                                    if($result=mysqli_query($link,$sql))
                                    {
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr><td>".$row["misschnum"]."</td>
                                                        <td>".$row["daytime"]."</td>
                                                        <td>".$row["outlook"]."</td>
                                                        <td>".$row["placename"]."</td>
                                                        <td>".$row["buildname"]."</td>
                                                        <td>".$row["sectionname"]."</td>
                                                        <td>".$row["kindname"]."</td>
                                                        <td>".$row["statename"]."</td>";
                                            if($row["photoname"]){
                                                echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                            }
                                            else{
                                                echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                            }
                                            if($row["stateid"] == 4){
                                                echo "<td><a href='miss_edit.php?action=find&id=".$row["misthingid"]."'><b>已尋獲</b></td></tr>";
                                            }
                                            else if($row["stateid"] == 5){
                                                echo "<td><a href='miss_edit.php?action=miss&id=".$row["misthingid"]."'><b>遺失中</b></td></tr>";
                                            }
                                        }
                                    }
                                    //echo "<script>alert(\"$sql\")</script>";
                                    mysqli_query($link,'set names utf8');
                                    mysqli_query($link,$sql);
}
                            }
                        }
                        //for使用者
                        else{
                            if(isset($_POST['Index']))
                            {
                                $sqlstate=$_POST['sql'];
                                $kindid=$_POST["kindid"];
                                $searchdaytime=$_POST["searchdaytime"];
                                $misschnum=$_POST['misschnum'];
                                $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                mysqli_select_db($link,"失物招領系統");
                                if($sqlstate==1)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.misschnum='$misschnum' AND misthing.rectime='$searchdaytime'";
                                    }
                                else if($sqlstate==2)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.misschnum='$misschnum'";
                                    }
                                else if($sqlstate==3)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid' AND misthing.rectime='$searchdaytime'";
                                    }
                                else if($sqlstate==4)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE  missthing.misschnum='$misschnum' AND misthing.rectime='$searchdaytime'";
                                    }
                                else if($sqlstate==5)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.misschnum='$misschnum' ";
                                    }
                                else if($sqlstate==6)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.kindid='$kindid'";
                                    }
                                else if($sqlstate==7)
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid WHERE misthing.rectime='$searchdaytime'";
                                    }
                                else
                                    {
                                        $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                    }
                                mysqli_query($link,'SET NAMES utf8');
                                if($result=mysqli_query($link,$sql))
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr><td>".$row["misschnum"]."</td>
                                                    <td>".$row["daytime"]."</td>
                                                    <td>".$row["outlook"]."</td>
                                                    <td>".$row["placename"]."</td>
                                                    <td>".$row["buildname"]."</td>
                                                    <td>".$row["sectionname"]."</td>
                                                    <td>".$row["kindname"]."</td>
                                                    <td>".$row["statename"]."</td>";
                                        if($row["photoname"]){
                                            echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                        }
                                        else{
                                            echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                        }
                                    }
                                }
                                //echo "<script>alert(\"$sql\")</script>";
                                mysqli_query($link,'set names utf8');
                                mysqli_query($link,$sql);
                            }
                            else if(isset($_POST['All']))
                            {
                                    
                                $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                mysqli_select_db($link,"失物招領系統");
                                $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                mysqli_query($link,'SET NAMES utf8');
                                if($result=mysqli_query($link,$sql))
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr><td>".$row["misschnum"]."</td>
                                                    <td>".$row["daytime"]."</td>
                                                    <td>".$row["outlook"]."</td>
                                                    <td>".$row["placename"]."</td>
                                                    <td>".$row["buildname"]."</td>
                                                    <td>".$row["sectionname"]."</td>
                                                    <td>".$row["kindname"]."</td>
                                                    <td>".$row["statename"]."</td>";
                                        if($row["photoname"]){
                                            echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                        }
                                        else{
                                            echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                        }
                                    }
                                }
                                //echo "<script>alert(\"$sql\")</script>";
                                mysqli_query($link,'set names utf8');
                                mysqli_query($link,$sql); 
                            }
                            else
                            {
                                $link= @mysqli_connect("localhost","root","")or die("無法開啟");
                                mysqli_select_db($link,"失物招領系統");
                                $sql="SELECT misthing.photoname,misthing.misthingid,misthing.misschnum,misthing.daytime,misthing.outlook,place.placename,building.buildname,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN (building INNER JOIN(misthing INNER JOIN place on misthing.placeid=place.placeid)ON building.buildid=place.buildid)ON building.sectionid=section.sectionid)ON misthing.kindid=category.kindid)ON misthing.stateid=state.stateid";
                                mysqli_query($link,'SET NAMES utf8');
                                if($result=mysqli_query($link,$sql))
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr><td>".$row["misschnum"]."</td>
                                                    <td>".$row["daytime"]."</td>
                                                    <td>".$row["outlook"]."</td>
                                                    <td>".$row["placename"]."</td>
                                                    <td>".$row["buildname"]."</td>
                                                    <td>".$row["sectionname"]."</td>
                                                    <td>".$row["kindname"]."</td>
                                                    <td>".$row["statename"]."</td>";
                                        if($row["photoname"]){
                                            echo "<td><img src='upload/".$row["photoname"]."' class='enlarge'></td>";
                                        }
                                        else{
                                            echo "<td><a href='miss_file_increase.php?id=".$row["misthingid"]."'><b>新增照片</b></td>";
                                        }
                                    }
                                }
                                //echo "<script>alert(\"$sql\")</script>";
                                mysqli_query($link,'set names utf8');
                                mysqli_query($link,$sql); 
                            }
                        }
                    ?>
                </table>
            </div>
            <div class="imgPreview"><!--放大後圖片的div-->
                <img src="#" alt="" id="imgPreview">
            </div>
        </section>

        <script> //12/11加，地點onchange
            var building_option = [
                [['紅樓','3'],['中山館','1'],['文薈樓','2'],['格致樓','7'],['思誠樓','9'],['誠正大樓','8']],
                [['榮譽A棟','4'],['榮譽B棟','5'],['榮譽C棟','6'],['榮譽D棟','10'],['榮譽E棟','11']]
            ];//所有建築物option的文字和value

            var place_option = [
                [['一樓','1'],['二樓','2'],['三樓','3']],
                [['JB101','19'],['JB102','20'],['JB103','21'],['JB104','22'],['JB106','23'],['JB108','24'],['JB109','25'],['JB110','26'],
                 ['J101','27'],['J102','28'],['J103','29'],['J104','30'],['J106','31'],['J108','32'],['J109','33'],
                 ['J201','34'],['J202','35'],['J203','6'],['J204','5'],['J205','38'],['J207','39'],['J208','40'],['J209','41'],['J210','42'],
                 ['J301','43'],['J302','44'],['J303','45'],['J304','46'],['J305','47'],['J306','48'],['J307','49'],['J308','50'],['J309','51'],['J310','52']],
                [['A303','57'],['A305','7'],['A307','59'],['A308','60'],['A310','61'],['A311','62']],
                [['ZA108','12'],['ZA201','64'],['ZA202','65'],['ZA203','11'],['ZA204','66'],['ZA205','67'],['ZA206','68'],['ZA207','69'],['ZA208','70'],
                 ['ZA301','71'],['ZA302','72'],['ZA303','73'],['ZA304','10'],['ZA305','74']],
                [['圖書館','75'],['ZB215','15'],['ZB301','13'],['ZB302','14']],
                [['ZC108','16'],['ZC109','17'],['ZC110','18']],
                [['C201','63']],
                [['圖書館','53'],['B308','54']],
                [['F101','55'],['F103','56']],
                [['ZD303','76']],
                [['ZE303','77']]
            ];//所有地點option的文字和value(row1是building_option[1]中的地點，row2是building_option[2]中的地點，...以此類推)

            function change_building(index) //選擇section後呼叫change_building函式, 更改building的選項
            {
                if (index == 0) 
                {
                    document.getElementById('building').innerHTML = "<option value=\"\">請先選擇校區</option>";
                }
                else 
                {
                    index--; //-1取得要new的option在building_option的第幾row
                    document.getElementById('building').innerHTML = "";
                    for (var i = 0; i < building_option[index].length; i++)
                        document.getElementById('building').innerHTML = document.getElementById('building').innerHTML +
                        "<option value=\"" + building_option[index][i][1] + "\">" + building_option[index][i][0] + "</option>"; // 設定新選項
                }
                change_place(0); //呼叫下一個函式
            }
            function change_place(index) //選擇building後呼叫change_place函式, 更改place的選項
            {
                var  j = document.getElementById('building').value; //這邊的j和上一個function的index功用相同，只是需要先取得building的value再-1才知道在place_option的第幾row
                
                if(j == 0)
                {   
                    document.getElementById('placeid').innerHTML = "<option value=\"\">請先選擇校區和建築物</option>";
                } 
                else
                {
                    j--;
                    document.getElementById('placeid').innerHTML = "";
                    for (var i = 0; i < place_option[j].length; i++)
                    document.getElementById('placeid').innerHTML = document.getElementById('placeid').innerHTML +
                        "<option value=\"" + place_option[j][i][1] + "\">" + place_option[j][i][0] + "</option>"; // 設定新選項
                }
            }
        </script>
        <script>
        $(function () 
        {
          $('.enlarge').on('click', function () 
          {
              var src = $(this).attr('src');
              $('.imgPreview img').attr('src', src);
              $('.imgPreview').show()
          });

          $('.imgPreview').on('click', function () {
              $('.imgPreview').hide()
          });
        })
        </script>

    </body>
</html>