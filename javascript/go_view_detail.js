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
               window.location.href = "view_created_job.php";
			}
		}
				xmlhttp.open('GET','view_created_job.php?value='+date_index,true);
               
        
		xmlhttp.send(null);
	}
}	