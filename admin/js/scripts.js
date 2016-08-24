tinymce.init({ selector:'textarea' });

$(function(){
    
     $('input #selectAll').click(function(event){
         if(this.checked){
             $('input .checkBoxes').each(function(){
                 this.checked = true;
             });
         } else{
             $('input .checkBoxes').each(function(){
                 this.checked = false;
             });
         }
     });
    
});