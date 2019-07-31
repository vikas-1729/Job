<html>
<head>
<script type="text/javascript">
var xmlhttp="false";

if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
}else if (window.ActiveXObject){
	xmlhttp= new ActiveXObject('Microsoft.XMLHTTP');
}
function view_date(date_index){
	if(xmlhttp){
		v=date_index;
		
		xmlhttp.onreadystatechange=function (){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("list").innerHTML=xmlhttp.responseText;
			}
		}
				xmlhttp.open('GET','modify_date.php?value='+date_index,true);
		xmlhttp.send(null);
	}
}	

</script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleCreateAjob.css">
</head>
<body>
<button class="button1" style="vertical-align:middle;display:inline;float:right;background-color:#ff4c4c; " onclick="window.location='login_org.php';" ><span>HOME</span></button>
 <p class="log" style="margin-left:center">Welcome Organization Name</p>
</body>
</html>

<?php
include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])){
		 
			
		 $query="SELECT `job_name`,`date` FROM `create_a_job` WHERE `org_id`='".$_SESSION['org_id']."'";
		 $query_run=mysqli_query($link,$query);
		 if($query_run==true){
			 if(mysqli_num_rows($query_run)>0){
			 print '<table width="80%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse">';
			 print "<tr><th>JOB NAME</th><th>CREATED ON</th><th>MORE INFORMATION</th></tr>";
			 $dates= array();
			 $i=0;
			while($row=mysqli_fetch_assoc($query_run)){
				print "<tr><td text-align='right'>".$row['job_name']."</td>";
				print "<td text-align='left'>".$row['date']."</td>";
				$dates[$i]=$row['date'];	
				$_SESSION['dates']=$dates;
				$i=$i+1;
				print "<td text-align='right' width='173px'><input type='button' value='modify date'onclick='view_date($i-1)'  name='view_date'></td></tr>";
			print "<div id='list'style='display:inline;width:175px;margin-right:-2.5px;'></div>";}
				
                if(isset($_POST['update_date'],$_POST['value'])&&!empty($_POST['update_date'])){
					$update_date=mysqli_real_escape_string($link,$_POST['update_date']);
					$query="UPDATE `create_a_job` SET `important_dates`='$update_date' WHERE `date`='$date'";
					$query_run=mysqli_query($link,$query);
					if($query_run==true){
						
						echo 'data has been updated';unset($_SESSION['value']);
					}else{
					echo mysqli_error($link);}
				}
					
			
 
				
				
		 
		 
		 }else{
		 echo "no job created";}
		 }
		 else{ echo mysqli_error($link);
		 }
 }

	
	}
	else
{header('Location:login.php');
}?>