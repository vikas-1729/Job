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
				xmlhttp.open('GET','org_information.php?value='+v,true);
		xmlhttp.send(null);
	}
}	

</script>
</head>
<body>

</body>
</html>
<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'],$_SESSION['dates'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&!empty($_SESSION['dates'])){
		 
			 $i= $_SESSION['value'];
			 $date=$_SESSION['dates'][$i];
			 $query="SELECT `username` FROM `job_status` WHERE `date`='$date'";
			 $query_run=mysqli_query($link,$query);
			 if($query_run==true){
				 
				 $count=mysqli_num_rows($query_run);
				 if($count>0){
				 $username_array=array($count);
				 $i=0;
				 $row=mysqli_fetch_assoc($query_run);
				 
				 while($count){
					 $username_array[$i]=$row['username'];
					 $i++;
					 $count--;
				 }$count=$i;
				 $_SESSION['username_job']=$username_array;
				 print '<table width="70%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse">';
				print "<tr><th>NAME</th><th>MOTHER'S NAME</th><th>MORE INFORMATION</th></tr>";
				 for($i=0;$i<$count;$i++){
					 $username_job=$username_array[$i];
					
					 $query="SELECT `first_name`,`surname`,`mother_name` FROM `profile` WHERE `username`='$username_job'";
					 $query_run=mysqli_query($link,$query);
			         if($query_run==true){
						if(mysqli_num_rows($query_run)==1){
						   if($row=mysqli_fetch_assoc($query_run)){
							print "<tr><td text-align='right'>".$row['first_name']." ".$row['surname']."</td>";
							print "<td text-align='left'>".$row['mother_name']."</td>";
							print "<td text-align='right'><input type='button' value='want a view detail'onclick='view_date($i)'  name='view detail'></td></tr>";
							print "<div id='list' style='display:inline;float:right;margin-right:195px;'> </div>";
							}
							else{
							echo mysqli_error($link);}
							}
					 }else{
					 echo mysqli_error($link);}
					
				 }
				 }else{
					 echo "NO ONE HAS APPLY";
				 }
			 }else{
				 echo mysqli_error($link);
			 }
	 }
 }else{
 header('Location:login.php');
 }?>