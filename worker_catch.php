<?php
//確認判斷均無誤再進行抓取
$state=$_POST['state'];
if($state=='1')
{
	$identity=$_POST['identity'];
	$name=$_POST['name'];
	$account=$_POST['account'];
	$password=$_POST['password'];
}
//將資料內容抓進資料庫
if(isset($_POST['Increase'])&& $state=='1')
{
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
  		//確認無重複account
  		while ($row=mysqli_fetch_assoc($result)) 
     	{
     		$sql="SELECT * FROM worker";
	        $alaccount = $row["account"];
	        if ($account == $alaccount)
	    	{
	     		$flag=TRUE;
	    	}
     	}     
        if($flag==TRUE)
	    {
	    	echo "<script> alert('此帳號已註冊'); </script>"; 
	    }
	    else
	    {
	    	$sql="INSERT INTO worker (account,password,name,identity) VALUES ('$account','$password','$name','$identity')";
			mysqli_query($link,'set names utf8');
   			mysqli_query($link,$sql);
	    }
    }
}
if (!empty($_SERVER['HTTP_REFERER']))
            header("Location: ".$_SERVER['HTTP_REFERER']);
?>