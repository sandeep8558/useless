$(function (){

    $("#handel").click(()=>{

        if($("#menu").hasClass("menu-out")){
            $("#menu").removeClass("menu-out");
            $("#panel").removeClass("panel-shrink");
        } else {
            $("#menu").addClass("menu-out");
            $("#panel").addClass("panel-shrink");
        }

    });

});
