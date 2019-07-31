var slideshow=0;
 
 showslide();
function showslide(){
    var i;
 
v=document.getElementsByClassName("myslideshow");
   
    for(i=0;i<v.length;i++){
        v[i].style.display="none";
    }
   
    slideshow++;
    if(slideshow>v.length){
        slideshow=1;}
    
    
     v[slideshow-1].style.display="block";
    

setTimeout(showslide,4*1000);
}
