 function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
            
             reader.onload = function (e) {                              
                 $('#gmbr').attr('src', e.target.result);
                 
                 /*variabel untuk dapetin tinggi*/
                 var img = new Image(); 
                 img.src = e.target.result;                     
                 var maxWidth = 4160;
                 var maxHeight = 3300;                           
                 /*end*/
                
                /*fungsi untuk dapetin tinggi*/
                 img.onload = function(){
                     var tmpWidth = this.height;
                     var tmpHeight = this.width;   
                     $("#Hwidth").val(tmpWidth);                     
                     $("#Hheight").val(tmpHeight);

                     if(tmpHeight>maxHeight){                                                                 
                        location.reload(true);
                     }
                 }
                 /*end*/ 
             }                                                 
                reader.readAsDataURL(input.files[0]);                                  
        }
    }
    $('#lblFileChoose').html("Choose File to Upload..!");

    $("#lblFile").change(function(x){            
        var GFile = x.target.files[0].name;         
        var fileExtension = GFile.replace(/^.*\./,'');        
        
         if (fileExtension == "png" || fileExtension == "jpg" 
            || fileExtension == "jpeg" || fileExtension == "gif")
        {          
           readURL(this);               
           var LocFile = URL.createObjectURL(event.target.files[0]);
           var SizeFile = x.target.files[0].size;
           var SizeFile = Math.round(SizeFile/1024)+" Kb ";            
           document.post_Verify.hsl.value = GFile; 
           document.post_Verify.LocFile.value = LocFile; 

           if(GFile != "" ){ 
              $('#lblFileChoose').html("");
              $('#lblFileChoose').html(GFile);
            }
        }else{            
            $('#myModal').modal({
               backdrop: 'static',
               keyboard: false
            }).on('click', '#btnClose', function(ax){
               location.reload(true);
            });

            $('#myModal').modal({
               backdrop: 'static',
               keyboard: false
            }).on('click', '#btnDismis', function(ax){
               location.reload(true);
            });            
        }                
    }); 

    //Buka gambar thumbnail di Tab baru
    $('#gmbr').click(function(){
      // location.href(document.post_Verify.LocFile.value);  
      $('#CGmbr').attr(window.open(document.post_Verify.LocFile.value)+ 'width=640,height=480');       
    });  