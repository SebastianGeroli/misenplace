$(document).ready(function(){

    //EDITOR CKEDITOR
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => { console.error( error ); } );

    //SELECT ALL CHECKBOXES
    $('#SelectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }else{
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }

    });


    //   var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    //    
    //    $("body").prepend(div_box);
    //    
    //    
    //    $('#load-screen').delay(700).fadeOut(600,function(){
    //        $(this).remove();
    //    });
    //    

    function loadUsersOnline(){
        $.get("functions.php?onlineUsers=result", function(data){
            $(".useronline").text(data);
        });
    }

    setInterval(function(){
        loadUsersOnline();
    },500);


});