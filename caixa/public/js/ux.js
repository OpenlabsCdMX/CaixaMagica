/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){

    $("div.title").click(toggleFullScreen);

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

    function toggleFullScreen() {
      var doc = window.document;
      var docEl = doc.documentElement;

      var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
      var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

      if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
        requestFullScreen.call(docEl);
      }
      else {
        cancelFullScreen.call(doc);
      }
    }

});
