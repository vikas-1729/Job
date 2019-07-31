<?php
include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])){
		 
		if(isset($_POST['first_name'],$_POST['surname'],$_POST['mother_name'],$_POST['recent_qualification'],$_POST['experience'],$_POST['dob'],
			$_POST['currently_study'],$_POST['college_name'],$_POST['passing_year'],$_POST['intrested_field1'],$_POST['intrested_field2']
			,$_FILES['file']['name'])){
				$first_name=mysqli_real_escape_string($link,$_POST['first_name']);echo "3";
				$surname=mysqli_real_escape_string($link,$_POST['surname']);
				$mother_name=mysqli_real_escape_string($link,$_POST['mother_name']);
				$recent_qualification=mysqli_real_escape_string($link,$_POST['recent_qualification']);
				$experience=mysqli_real_escape_string($link,$_POST['experience']);
				$dob=mysqli_real_escape_string($link,$_POST['dob']);
			    $currently_study=mysqli_real_escape_string($link,$_POST['currently_study']);
				$college_name=mysqli_real_escape_string($link,$_POST['college_name']);
				$passing_year=mysqli_real_escape_string($link,$_POST['passing_year']);
				$intrested_field1=mysqli_real_escape_string($link,$_POST['intrested_field1']);
				$intrested_field2=mysqli_real_escape_string($link,$_POST['intrested_field2']);
	             $username=$_SESSION['username'];		
				$name=$_FILES['file']['name'];
				if(!empty($username)&&!empty($surname)&&!empty($mother_name)&&!empty($recent_qualification)&&!empty($experience)&&!empty($dob)
					&&!empty($currently_study)&&!empty($college_name)&&!empty($passing_year)&&!empty($intrested_field1)&&!empty($intrested_field2)
				&&!empty($name)){echo "4";
						$status="complete";
						
					
				
					
					$folder_name=substr($_SESSION['username'],0,10);
				   mkdir($folder_name.'/',0777,true);
			      $from=$_FILES['file']['tmp_name'];
		         $to=$folder_name.'/';
			      $_SESSION['file_link_job']=$to;
				  if(move_uploaded_file($from,$to.$name)){
				  echo "file has been uploded";}
				
			
			$query="UPDATE `profile` SET `first_name`='$first_name',`surname`='$surname',`mother_name`='$mother_name',`dob`='$dob',
			`recent_qualification`='$recent_qualification',`currently_study`='$currently_study',`college_name`='$college_name',`passing_year`='$passing_year',
			`intrested_field1`='$intrested_field1',`intrested_field2`='$intrested_field2',`status`='complete' WHERE `username`='".$_SESSION['username']."'";
			$query_run=mysqli_query($link,$query);
		         if($query_run==true){
					 if($status=="complete")
					 { print "<script> alert('you can now  apply for job ') </script>";
					 }
				 }else{
				 echo mysqli_error($link);}
				}else{
		echo "plz  fill all the filed";}
			}
}
		
 
 }else{
	 header('Location:login.php');
 }
 
 
 
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="job_profile.css">
</head>
    <body>    <button class="button1" style="vertical-align:middle" onclick="window.location='login_job.php';" ><span>HOME</span></button>
<div class="main">
<p class="log">Profile </p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <p id="a1">First Name:</p>
           <div id="b1">
<input type ="text" name="first_name" value="<?php if(!empty($first_name)) echo $first_name;?>" ></div><br>
<p id="a2">LastName:</p>
               <div id="b2">
                   <input type ="text" name="surname" value="<?php if(!empty($surname)) echo $surname;?>" ></div><br>
<p id="a3">Mother's Name:</p>
           <div id="b3">
               <input type ="text" name="mother_name" value="<?php if(!empty($mother_name)) echo $mother_name;?>" ></div><br>

<p  id="a4">Recent Qualification:</p>
    <div id="b4">
<select name="recent_qualification">
<option value="B.TECH">B.TECH </option>
<option value="M.TECH">M.TECH</option>
<option value="MCA">MCA</option>
<option value="BCA">BCA</option>
</select></div><br>
<p id ="a5">Experience:</p>        
          <div id="b5">  

              <input type ="text" name="experience"  value="<?php if(!empty($experience)) echo $experience;?>" ></div><br>
<p id ="a6">DOB:(FORMAT YYYY-MM-DD)</p>        
          <div id="b6"> 
              <input type ="text" name="dob"  value="<?php if(!empty($age_group)) echo $age_group;?>" ></div><br>

    <p id="a7">Currently Study:</p>
    <div id="b7">
<select name="currently_study">
<option value="B.TECH">B.TECH </option>
<option value="M.TECH">M.TECH</option>
<option value="MCA">MCA</option>
<option value="BCA">BCA</option>
<option value="other">OTHER</option>
        </select></div><br>

    <p id ="a8">College Name:</p>        
          <div id="b8">
              <input type ="text" name="college_name"  value="<?php if(!empty($college_name)) echo $college_name;?>" ></div><br>

    <p id ="a9">Passing Year: </p>        
          <div id="b9">
              <input type ="int" name="passing_year" value="<?php if(!empty($passing_year)) echo $passing_year;?>" ></div><br>

              
    <p id ="a10">Intrested Field (If Any):</p>        
          <div id="b10">
              <input type ="text" name="intrested_field1"  value="<?php if(!empty($intrested_field1)) echo $intrested_field1;?>" ></div>
    <div id="b13"><input type ="text" name="intrested_field2"  value="<?php if(!empty($intrested_field2)) echo $intrested_field2;?>" ></div><br>
              <p id ="a11">UPLOAD YOUR MIN QUALIFICATION DOCUMENT</p>
<input type="file" name="file">
<button class="button2" style="vertical-align:middle" onclick="window.location='login.php';" >Submitted</button>           
</form>
    </div></div>
</body>
</html>
