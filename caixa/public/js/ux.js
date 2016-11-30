/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){

    //load Hamburguer menu with desktop menu content
    $("#hamburguer-content ul.nav").html($("#desktop-menu").html());

    $("#sombra").height($("#hamburguer-content").height());

    //Hamburguer btn listenner
    $("#hamburguer").click(function(){
        let element = $("#"+$(this).data("target"));
        let sombra = $("#sombra");

        if(element.data("hidden")){
          element.animate({
            left:"0px"
          },350);
          element.data("hidden",false);
        }else{
          element.animate({
            left:'-'+element.outerWidth()+"px"
          },350);
          element.data("hidden",true);
        }
        sombra.fadeToggle();
    });

});
