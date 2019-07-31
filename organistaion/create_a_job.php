<?php
include("connect_database.php");
if(isset($_SESSION['username'],$_SESSION['type'])){
if(isset($_POST['job_name'],$_POST['location'],$_POST['experience'],$_POST['qualification'],$_POST['age_group'],$_POST['age_group'],$_POST['salary']
,$_POST['important_dates'],$_FILES['file']['name'])){
	$job_name=mysqli_real_escape_string($link,$_POST['job_name']);
	$location=mysqli_real_escape_string($link,$_POST['location']);
	$experience=mysqli_real_escape_string($link,$_POST['experience']);
	$qualification=mysqli_real_escape_string($link,$_POST['qualification']);
	$age_group=mysqli_real_escape_string($link,$_POST['age_group']);
	$salary =mysqli_real_escape_string($link,$_POST['salary']);
	$important_dates=mysqli_real_escape_string($link,$_POST['important_dates']);
	$name=$_FILES['file']['name'];
    if(!empty($job_name)&&!empty($location)&&!empty($experience)&&!empty($qualification)&&!empty($age_group)&&!empty($salary)&&!empty($important_dates)
	&&!empty($name)){
	
		
		
			$folder_name=substr($_SESSION['org_name'],0,10);
			
			mkdir($folder_name.'/'.$job_name.'/',0777,true);
			$from=$_FILES['file']['tmp_name'];
		    $to=$folder_name.'/'.$job_name.'/';
			$_SESSION['file_link']=$to;
			if(move_uploaded_file($from,$to.$name)){
			 $time=date(" g:i a",time()+3*60*60+30*60);
			 $date=date("d-M-Y");
			 $date=$date." "."at"." ".$time;
				$query="INSERT INTO `create_a_job` (`org_name`,`location`,`job_name`,`qualification`,`experience`,`age_group`,`salary`,`important_dates`,`org_id`,`date`)
				VALUES('".$_SESSION['org_name']."','$location','$job_name','$qualification','$experience','$age_group','$salary','$important_dates','".$_SESSION['org_id']."',
				'$date')";
				
				$query_run=mysqli_query($link,$query);
		         if($query_run==true){
					 print "<script> alert('further you can only extend date and not change other data or you have to delete the job') </script>"; 
					 echo "thanku for creating a job:";
					  
				 }else{
				 echo mysqli_error($link);}
			}else{
				echo "upload failed";
			}
		}else{
		echo "plz fill all the field";
	}
	}
	
}
		
			
	
?>

<html>
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleCreateAjob.css">
    </head>
<body>
<button class="button1" style="vertical-align:middle" onclick="window.location='login_org.php';" ><span>HOME</span></button>      
       
        
       
<div class="main">
<p class="log">Create A Job</p>
<form name="create_a_job.php"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
<label class ="l1 " for="uname"><b>Job Type  :</b></label>
<div class="p">
    <input type ="text" name="job_name" value="<?php if(!empty($job_name)) echo $job_name;?>" ></div>
<br><label class ="l1 " for="uname"><b>Location  :</b></label>
<div class="g">
    <input type ="text" name="location" value="<?php if(!empty($location)) echo $location;?>" ></div>
<br><label class ="li5 " for="uname"><b>ELIGIBILITY:: </b></label><br>
    <label class ="li1 " for="uname"><b>1.Qualification:</b></label>
    
<select name="qualification">
<option value="B.TECH">B.TECH </option>
<option value="M.TECH">M.TECH</option>
<option value="MCA">MCA</option>
<option value="BCA">BCA</option>
        </select><br><br>
        <label class ="li1" for="uname"><b>2.Experience:</b></label>
    <div class="i"><input type ="text" name="experience"  value="<?php if(!empty($experience)) echo $experience;?>" ></div>
    
    <br><label class ="l1 " for="uname"><b>Age Group:</b></label>
    <div class="h">
        <input type ="text" name="age_group"  value="<?php if(!empty($age_group)) echo $age_group;?>" ></div>
<br><label class ="l1 " for="uname"><b>Salary:</b></label>
    <div class="k">
        <input type ="text" name="salary" value="<?php if(!empty($salary)) echo $salary;?>" ></div>
    <br><label class ="l1 " for="uname"><b>Imporatant dates:</b></label>
    <div class="l">
        <input type ="text" name="important_dates"  value="<?php if(!empty($important_dates)) echo $important_dates;?>" ></div>
<br><label class ="l13" for="uname"><b>UPLOAD INFORMATION PDF</b></label><br>
<div id="b">
    <input  type="file" name="file">
    </div>
<button class="button2" style="vertical-align:middle" onclick="window.location='create_a_job.php';" >CREATE</button>           
    </form></div>
    </div>
</body>
</html>
