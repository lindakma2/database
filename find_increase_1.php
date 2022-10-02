
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Increase miss</title>
</head>
<body>

<form method="post" action="find_increase.php" name="enter">
帳號: <input type="text" id="account" name="account" /><br/>
密碼: <input type="password" id="password" name="password" /><br/>
<input type="submit" name="Login" value="登入"/>
<input type="submit" name="Logout" value="登出"/>
</form>

<form method="post" action="find_catch.php" name="enter " enctype="multipart/form-data">
拾獲者: <input type="text" id="pickname" name="pickname" /><br/>
外觀描述: <input type="text" id="outlook" name="outlook" /><br/>
拾獲分類:<select name="kindid">
        <option>水壺
        <option>雨傘
        <option>服飾類
        <option>飾品類
        <option>3c產品
        <option>學生證
        <option>其他物品</select><br/>
拾獲日期: <input type="date" name="daytime" /><br/>
拾獲地點:<select name="section" id="section">
        <option>校本部</option>
        <option>榮譽校區</option></select> 
        <select name="building" id="building" >
        <option>操場</option>
        <option>圖書館</option>
        </select>
        <select name="placeid" id="placeid" >
        <option>301</option>
        <option>302</option>
        </select><br/>

<input type="hidden" id="state" name="state" value="1">
<input type="submit" name="Register" value="登記" />
</form>

//查詢
<form method="post" action="find_increase.php" name="enter">

<input type="checkbox" name="checkbox" value="checkbox">僅顯示未領取<br/>
<input type="checkbox" name="checkbox" value="checkbox">拾獲分類:<select name="kindid">
        <option value="1">水壺
        <option >雨傘
        <option>服飾類
        <option>飾品類
        <option>3c產品
        <option>學生證
        <option>其他物品</select><br/>
<input type="checkbox" name="checkbox" value="checkbox">
拾獲日期: <input type="date" id="searchdaytime" name="searchdaytime" /><br/>

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

<?php
session_start();
$_SESSION["check"]=false;
//管理員帳號登入

if(isset($_POST['Login']))
{
        $account=$_POST['account'];
        $password=$_POST['password'];
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        if(!$link)
        {
                echo "error";
        }
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
                        }
                }
        }
}

if(isset($_POST['Logout']))
{
        $_SESSION["check"]=false;
}
?>

<?php
//for使用者列表呈現


if(isset($_POST["Index"]))
{
        $sqlstate=$_POST['sql'];
        $kindid=$_POST["kindid"];
        $searchdaytime=$_POST["searchdaytime"];
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        if($sqlstate==1)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.kindid='$kindid' AND findthing.stateid='1' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==2)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.kindid='$kindid' AND findthing.stateid='1'";
        }
        else if($sqlstate==3)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.kindid='$kindid' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==4)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.stateid='1' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==5)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.stateid='1'";
        }
        else if($sqlstate==6)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.kindid='$kindid'";
        }
        else if($sqlstate==7)
        {
                $sql="SELECT findthing.photoname,findthing.findthingid,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid WHERE findthing.rectime='$searchdaytime'";
        }
        else
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid";
        }
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["statename"]."</td></tr></br>";

                }
                echo "</table>";
        }
        //echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}
else if(isset($_POST["All"]))
{
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        $sql="SELECT findthing.photoname,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid";
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["statename"]."</td></tr></br>";
                }
                echo "</table>";
        }
        //echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}
else
{
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        $sql="SELECT findthing.photoname,findthing.getname,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename FROM state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid";
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["statename"]."</td></tr></br>";

                }
                echo "</table>";
        }
        //echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}  
?>
<?php
//for管理員列表呈現
if(isset($_POST["Index"]))
{
        $sqlstate=$_POST['sql'];
        $kindid=$_POST["kindid"];
        $searchdaytime=$_POST["searchdaytime"];
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");

        if($sqlstate==1)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingid WHERE findthing.kindid='$kindid' AND findthing.stateid='1' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==2)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingidWHERE findthing.kindid='$kindid' AND findthing.stateid='1'";
        }
        else if($sqlstate==3)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingidWHERE findthing.kindid='$kindid' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==4)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingidWHERE findthing.stateid='1' AND findthing.rectime='$searchdaytime'";
        }
        else if($sqlstate==5)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingidWHERE findthing.stateid='1'";
        }
        else if($sqlstate==6)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingidWHERE findthing.kindid='$kindid'";
        }
        else if($sqlstate==7)
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingid WHERE findthing.rectime='$searchdaytime'";
        }
        else
        {
                $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingid";
        }
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["findrecacc"]."</td><td>".$row["getrecacc"]."</td><td>".$row["returntime"]."</td><td>".$row["statename"]."</td>";
                        echo "<td><a href='find_file_increase.php?id=".$row["findthingid"]."'><b>新增照片</b></td>";
                        echo "<td><a href='find_edit.php?action=miss&id=".$row["findthingid"]."'><b>更新狀態</b></tr>";
                }
                echo "</table>";
        }
        //echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}
else if(isset($_POST["All"]))
{
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingid";
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["findrecacc"]."</td><td>".$row["getrecacc"]."</td><td>".$row["returntime"]."</td><td>".$row["statename"]."</td>";
                        //echo "<img src='./upload/".$row["photoname"]."' />";
                        echo "<td><a href='find_file_increase.php?id=".$row["findthingid"]."'><b>新增照片</b></td>";
                        echo "<td><a href='find_edit.php?action=miss&id=".$row["findthingid"]."'><b>更新狀態</b></tr>";
                }
                echo "</table>";
        }
        echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}
else
{
        $link= @mysqli_connect("localhost","root","")or die("無法開啟");
        mysqli_select_db($link,"失物招領系統");
        $sql="SELECT findthing.photoname,findthing.getname,findthing.findthingid,findthing.pickname,findthing.outlook,findthing.rectime,place.placename,building.buildname ,section.sectionname,category.kindname ,state.statename ,worker.name AS findrecacc ,T1.name AS getrecacc,findthing.returntime FROM  (SELECT worker.name,findthing.findthingid FROM worker RIGHT JOIN findthing ON findthing.getrecacc=worker.account)AS T1 RIGHT JOIN(worker RIGHT JOIN(  state INNER JOIN(category INNER JOIN(section INNER JOIN(building INNER JOIN( place INNER JOIN findthing ON findthing.placeid=place.placeid)ON place.buildid=building.buildid)ON building.sectionid=section.sectionid)ON findthing.kindid=category.kindid)ON findthing.stateid=state.stateid)ON worker.account=findthing.findrecacc) ON T1.findthingid=findthing.findthingid";
        mysqli_query($link,'SET NAMES utf8');
        if($result=mysqli_query($link,$sql))
        {
                echo "<table>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr><td>".$row["pickname"]."</td><td>".$row["getname"]."</td><td>".$row["outlook"]."</td><td>".$row["rectime"]."</td><td>".$row["placename"]."</td><td>".$row["buildname"]."</td><td>".$row["sectionname"]."</td><td>".$row["kindname"]."</td><td>".$row["findrecacc"]."</td><td>".$row["getrecacc"]."</td><td>".$row["returntime"]."</td><td>".$row["statename"]."</td>";
                        echo "<td><a href='find_file_increase.php?id=".$row["findthingid"]."'><b>新增照片</b></td>";
                        echo "<td><a href='find_edit.php?action=miss&id=".$row["findthingid"]."'><b>更新狀態</b></tr>";
                }
                echo "</table>";
        }
        //echo "<script>alert(\"$sql\")</script>";
        mysqli_query($link,$sql);
}  
?>
</body>
</html>