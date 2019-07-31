<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])){
		 $query="SELECT `org_id`,`org_name` FROM `register_org` WHERE `username`='".$_SESSION['username']."'";
		$query_run=mysqli_query($link,$query);
		if($query_run==true){
			$row=mysqli_fetch_assoc($query_run);
			$_SESSION['org_id']=$row['org_id'];
			$_SESSION['org_name']=$row['org_name'];
			
	 }
	 
 }
 else{
   header("Location:login.php");
 }
 }?>
		 
 <html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type ="text/css" rel="stylesheet" href="loginasorganization.css"/>
</head>
<body>
    <div class="header">

        
        <button class="button2" style="vertical-align:middle"onclick="window.location='logout.php';"   ><span>LOGOUT</span></button>  
         <p class="log">Welcome Organization Name</p>
    </div><div class="abc">
<div class="btn-group" style ="margin-left:80px;">
    <button class="button"  onclick="window.location='create_a_job.php';"><span>Create A Job</span></button>
    <button class="button" onclick="window.location='view_detail.php';"><span>View Created Job</span></button>
<button  class="button" onclick="window.location='modifying_date.php';"><span>Modify The Date</span></button>
    </div>
</div>
</body>
</html>