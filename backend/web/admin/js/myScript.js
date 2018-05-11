$("document").ready(function(){ 

     var baseUrl = window.location.origin;
     $("body").on("click",'.checkAllModule',function(){
        var id = $(this).attr('id');
        var checkbox = 'checkbox'+id;
        //alert(checkbox);
        //$(checkbox)
        if($(this).hasClass('onchecked')){
             $('.'+checkbox).prop('checked', false);
            $('.'+checkbox).parent('span').removeClass('checked');
            $(this).removeClass('onchecked');
        }else{
            $('.'+checkbox).prop('checked', true);
            $('.'+checkbox).parent('span').addClass('checked');
            $(this).addClass('onchecked');
        }
     });  
     // FCKEDITOR
    for(var name in CKEDITOR.instances)
    {
        CKEDITOR.instances[name].destroy(true);
    }
    // if($("textarea[name='Projects[INFO]']").length) {
    //    ckeditorFull('Projects[INFO]');
    // }
    if($("textarea[name='Projects[CONTENT]']").length) {
       ckeditorFull('Projects[CONTENT]');
    }
    if($("textarea[name='Projects[POLICY]']").length) {
       ckeditorFull('Projects[POLICY]');
    }if($("textarea[name='Projects[OVERVIEW]']").length) {
       ckeditorFull('Projects[OVERVIEW]');
    }if($("textarea[name='Projects[LOCATION]']").length) {
       ckeditorFull('Projects[LOCATION]');
    }if($("textarea[name='Projects[UTILITI]']").length) {
       ckeditorFull('Projects[UTILITI]');
    }if($("textarea[name='Projects[GROUND]']").length) {
       ckeditorFull('Projects[GROUND]');
    }if($("textarea[name='Projects[PROGRESS]']").length) {
       ckeditorFull('Projects[PROGRESS]');
    }
    
    
    if($("textarea[name='Articles[CONTENT]']").length) {
       ckeditorFull('Articles[CONTENT]');
    }
   
    

    
 });