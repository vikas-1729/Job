<?php
 include("connect_database.php");
 
 if(isset($_SESSION['username'],$_SESSION['type'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&($_SESSION['type']=='j')){
		 echo "welcome".$_SESSION['username'];
	 }else{
	 header('Location:login.php');}
 }else{
	 header('Location:login.php');
 }?>
 <html>
<head>
<script type="text/javascript">
var xmlhttp="false";

if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
}else if (window.ActiveXObject){
	xmlhttp= new ActiveXObject('Microsoft.XMLHTTP');
}
function predict_org(i){
	if(xmlhttp){
		
		var index=i;
		if(index==1){
		var v=document.search1.search_org.value;
		var the_div="list1";}
		else if(index==2){
			var v=document.search2.search_job.value;
			var the_div="list2";}
			
		
		xmlhttp.onreadystatechange=function (){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById(the_div).innerHTML=xmlhttp.responseText;
			}
		}
				xmlhttp.open('GET','auto_suggest.php?value='+v+'&index='+index,true);
		xmlhttp.send(null);
	}
}
function view_date(date_index){
	if(xmlhttp){
		v=date_index;
		
		xmlhttp.onreadystatechange=function (){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("list").innerHTML=xmlhttp.responseText;
			}
		}
				xmlhttp.open('GET','org_information.php?value='+date_index,true);
		xmlhttp.send(null);
	}
}		

</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type ="text/css" rel="stylesheet" href="login_job.css"/>

</head>
<body>
    <div class="header">
  
        <button class="button3" onclick="window.location='job_profile.php';"><span>PROFILE</span></button>
       
        
        <button class="button2" style="vertical-align:middle"  onclick="window.location='logout.php';"> <span>LOGOUT</span></button>  
        <button  class="button4" onclick="window.location='view_applied_status.php';"><span>view applied status</span></button>
        <p class="log">Welcome Seeker Name</p></div>
    <div class="btn-group" style ="margin-left:20px;" >

     </div>
<form name="search1" style="display:inline;position:relative;margin-top:15px;" action="login_job.php" method="POST">
  
<input type="text" onkeyup="predict_org(1)" name="search_org">
        <input type="submit" value="Search by org name">
		
</form> 
<form name="search2" style="display:inline;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

    <input type="text" onkeyup="predict_org(2)" name="search_job">
<input type="submit" value="Search by job name">

</form> 
 <div id="list1"></div>
<div style="margin-left:320px;"id="list2"></div>   
</body>
</html>


<?php
 		 if(isset($_POST['search_org'])&&!empty($_POST['search_org'])){
			 	$search_org=mysqli_real_escape_string($link,$_POST['search_org']);
				
				 $query="SELECT `job_name`,`date` FROM `create_a_job` WHERE `org_name`='$search_org'";
		 $query_run=mysqli_query($link,$query);
		 if($query_run==true){
			 if(mysqli_num_rows($query_run)>0){
			 print '<table width="75%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse">';
			 print "<tr><th>JOB NAME</th><th>CREATED ON</th><th>MORE INFORMATION</th></tr>";
			 $dates= array();
			 $i=0;
			while($row=mysqli_fetch_assoc($query_run)){
				print "<tr><td text-align='right'>".$row['job_name']."</td>";
				print "<td text-align='left'>".$row['date']."</td>";
				$dates[$i]=$row['date'];	
				$_SESSION['dates']=$dates;
				$i=$i+1;
				print "<td text-align='right'><input type='button' value='want a view detail'onclick='view_date($i-1)'  name='view detail'></td></tr>";
				print"<div id='list'></div>";
		 
	 }
			 }else{
				 echo "no job has been created by companay till";
			 }
		 }else{
		 echo mysqli_error($link);}
		 }
		 if(isset($_POST['search_job'])&&!empty($_POST['search_job'])){
			 	$search_job=mysqli_real_escape_string($link,$_POST['search_job']);
				 $query="SELECT `org_name`,`date` FROM `create_a_job` WHERE `job_name`='$search_job'";
		 $query_run=mysqli_query($link,$query);
		 if($query_run==true){
			 if(mysqli_num_rows($query_run)>0){
			 print '<table width="75%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse">';
			 print "<tr><th>ORG. NAME</th><th>CREATED ON</th><th>MORE INFORMATION</th></tr>";
			 $dates= array();
			 $i=0;
			while($row=mysqli_fetch_assoc($query_run)){
				print "<tr><td text-align='right'>".$row['org_name']."</td>";
				print "<td text-align='left'>".$row['date']."</td>";
				$dates[$i]=$row['date'];	
				$_SESSION['dates']=$dates;
				$i=$i+1;
				print "<td text-align='right'><input type='button' value='want a view detail'onclick='view_date($i-1)'  name='view detail'></td></tr>";
				print"<div id='list'></div>";
		 
	 }
			 }else{
				 echo "no job has been created in this field till";
			 }
		 }else{
		 echo mysqli_error($link);}
		 }
	?>