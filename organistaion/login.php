<?php
include("connect_database.php");
if(isset($_POST['username'],$_POST['password'],$_POST['captcha'],$_POST['captcha1'])){
	
	$username=mysqli_real_escape_string($link,$_POST['username']);
	$password=mysqli_real_escape_string($link,$_POST['password']);
	$captcha=mysqli_real_escape_string($link,$_POST['captcha']);
	$captcha1=mysqli_real_escape_string($link,$_POST['captcha1']);
	if(!empty($username)&&!empty($password)&&!empty($captcha)&&!empty($captcha1)){
		if($link){
			if($captcha1==$captcha){
				echo "2nd";$_POST['captcha']=0;
				$query="SELECT `password`,`type`,`username` FROM `login` WHERE `username`='$username'";
				$query_run=mysqli_query($link,$query);
				if($query_run==true){
					if(mysqli_num_rows($query_run)==1){
						$row=mysqli_fetch_assoc($query_run);
						if($row['password']==$password){
							$_SESSION['type']=$row['type'];
							$_SESSION['username']=$row['username'];
							switch($row['type']){
								case 'c':header("Location:login_org.php");
								         break;
								case 'j':header("Location:login_job.php");
						               	break;}
						}else{
						echo "invalid password";}
					}else{
					echo "invalid username ";}
				}
			}else
			{echo "wrong captcha";
		        $_POST['captcha']=0;}
		}else
		{echo "error".mysqli_error($link);}
	}else
	{echo "plz fill all the field";
          $_POST['captcha']=0;}
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="login.css">
    </head>
    <body><button class="button" style="vertical-align:middle"  ><span>HOME</span></button>      
        <div class="outer">
<div class="main">
<p class="log">Login </p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<label class ="l1 " for="uname"><b>Username:</b></label>
<div class="i">
    <input type ="text" name="username" required><br></div>
<label class ="l1 "  for="psw"><b>Password :</b></label>
<div class="j">

    <input class ="g" type="password" name="password" required><br></div>
<label class ="l1 "  for="cap"><b>Captcha  :</b></label>
    <div class="h">
<input  type="text" style="height:16px;width:95px;"name="captcha" value="<?php $capt=rand(1000,99999);if(empty($_POST['captcha'])) echo $capt;?>" required></div><br><label class ="l1 "  for="psw"><b> Type Captcha:</b></label>
    <input class ="g"  type="text"style="height:16px;width:95px" name="captcha1"  required><br>
    <label class ="l1 " >
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
 <button class="button2" style="vertical-align:middle" onclick="window.location='login.php';" >LOGIN</button>           </div>
            </div>
</form>            
</body>
</html>