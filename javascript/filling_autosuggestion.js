function show(fill_this,index){//FILLING AUTOSUGGESTION
                if(index==1){
                    document.forms[0].elements[0].value=fill_this;
                    document.getElementById('search_org_content').style.display="none";
                }
                else if(index==2){
                    document.forms[1].elements[0].value=fill_this;
                    document.getElementById('search_job_content').style.display="none";
                }
            }
            function display(index){//MAKE DISPLAY BLOCK
                if(index==1){
                      document.getElementById('search_org_content').style.display="block";
                }
                else if(index==2){
                      document.getElementById('search_job_content').style.display="block";
                }
            }