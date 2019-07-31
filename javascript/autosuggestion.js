          
var xmlhttp="false";
if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
}else if (window.ActiveXObject){
	xmlhttp= new ActiveXObject('Microsoft.XMLHTTP');
}
function predict_name(i){
	if(xmlhttp){//AUTOSUGGESTION 
		
		var index=i;
		if(index==1){
		var v=document.forms[0].elements[0].value;
		var the_div="search_org_content";}
		else if(index==2){
			var v=document.forms[1].elements[0].value;
			var the_div="search_job_content";}
			
		
		xmlhttp.onreadystatechange=function (){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById(the_div).innerHTML=xmlhttp.responseText;
                
			}
		}
				xmlhttp.open('GET','auto_suggest.php?value='+v+'&index='+index,true);
		xmlhttp.send(null);
	}
}