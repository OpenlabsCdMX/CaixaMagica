/**
* Mágicarousel. A flexbox carousel
*
* @author Pablo Bejarano (@Pabhoz)
* @version 1.0.0
*
* Based on the flexbox-carousel by Andi Smit @ https://github.com/andismith
*/
$(function(){

  //use Modernizr.prefixed to get the prefixed version of boxOrdinalGroup
  var boxOrdinalGroup = Modernizr.prefixed( 'boxOrdinalGroup' );
  var touches = { startX: 0, endX: 0};

  $.each($(".magicarousel"),function(){

      let magicarousel = $(this);
      //global (magicarousel) vars.
      var [items,active] = [magicarousel.find("ul")[0],0];

      //init frontal item
      $(items.children[0]).addClass("frontal");

      if(items.children.length > 1){//Si existe más de una opción...
      //Assign listeners to magicarousel childs
      for (var i = 0; i < items.children.length; i++) {
        //on click listener
        $(items.children[i]).click(function(){
          //if this option group have a commentBox displayed, hide it until an option is selected again
          var cb = $(this).parent().parent().parent().parent().children(".commentBox");
          if(cb.length){
            //console.log(cb);
            cb[0].style.display = "none";
          }
          if(!$(this).hasClass("frontal")){//if this item isn't the frontal one
            let clicked = $(this).index();
            var direction = -1;
            //if clicked one is the last one (left one at beginning)
            if(clicked == items.children.length-1 && active == 0){
              direction = 1;
              changeOrdinal(items);
            }else{
              //if clicked one is the first one element and active is the last
              if(clicked == 0 && active == items.children.length-1){
                direction = -1;
              }else{//if the clicked one isn't first or last
                  direction = (clicked > active) ? -1 : 1;
              }
            }
            active = clicked; //the clicked one now is the active one
            //move the elements in an specific direction detected
            moveIt($(this).parent(),items,direction,active);
          }else{//if it is the frontal one
            var el = $(this);
            el.addClass("selected");
            //play audio
            var audio = new Audio('../../public/assets/sounds/Pop.mp3');
            audio.play();

            //if this is an OpcionAbierta do!
            if(el.data("tipo") == "OpcionAbierta"){
              //if commentBox Doesn't exist create one
              var cb = el.parent().parent().parent().parent().children(".commentBox");
              if(cb.length < 1){
                var textArea = document.createElement("textArea");
                textArea.className = "commentBox";
                textArea.placeholder = "Escribe aquí...";
                var contenedor = el.parent().parent().parent().parent();
                contenedor.append(textArea);
              }else{
                cb[0].style.display = "block";
              }
            }

          }
        });
        //on touch move over carousel
        $(magicarousel).bind("touchstart",function(e){
          var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
          touches.startX = touch.clientX;
        });
        $(magicarousel).bind("touchend",function(e){
          e.stopImmediatePropagation();
          var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
          touches.endX = touch.clientX;
          if((touches.startX - touches.endX) > 20){
            //mover a la derecha
            if(active == items.children.length - 1){
              index = 0;
            }else{
              if(active == items.children.length - 2){
                index = active;
              }else{
                index = active + 1;
              }
            }
            $(items.children[index]).trigger("click");
          }
          if((touches.startX - touches.endX) < -20){
            //mover a la izquierda
            if(active == 0){
              index = items.children.length - 1;
            }else{
              if(active == items.children.length - 1){
                index = active;
              }else{
                index = active - 1;
              }
            }
            $(items.children[index]).trigger("click");
          }
        });
      }

    }else{//Si es solo una, centrala y no la dejes mover.
      var ul = $(items.children[0]).parent();
      ul[0].style.width = ul.parent()[0].offsetWidth+"px";
      ul[0].style.marginLeft = 0;
      console.debug();
      items.children[0].style.margin = "auto";
    }

      //change the ordinal of carousel to create infinite effect
      changeOrdinal(items);
  });
  /**
  * @author Pablo Bejarano (@Pabhoz)
  * @desc Recives a direction and new active element to move the margin of carousel items parent
  * to create the movement animation
  * @param direction int between -1 and 1. determines the direction of movement
  * @param newActive int. new active magicarousel element index
  */
  function moveIt(carousel,items,direction,newActive){
    carousel.find(".selected").removeClass("selected");//remove selection if exists
    carousel.find(".frontal").removeClass("frontal");//remove frontal from old active one
    $(items.children[newActive]).addClass("frontal");//add frontal class to new active one
    //get the computed styles of items parent
    var itemStyle = window.getComputedStyle( items, null ) || items.currentStyle;
    //get the computed margin left of carousel items parent
    let currentMargin = parseInt(itemStyle.marginLeft);
    //get an element of magicarousel who's not the frontal one
    let carrouselItem = carousel.find("li:not(.frontal)");
    //save the width and margin of one of the carousel items to calculate new parent margin
    var adjust = {
      w: carrouselItem.width(),
      m: parseInt($(carrouselItem).css("margin-right").replace("px", ""))
    };
    //new margin of parent
    var margin = direction * (( adjust.w ) +  adjust.m);
    //animate margin movement
    $(items).animate({marginLeft: (currentMargin + margin)+'px'});
  }

  /**
  * @author Andi Smith
  * @modify Pablo Bejarano (@Pabhoz) on 12/02/16
  */
  function changeOrdinal(items) {
      var [length,ordinal] = [items.children.length,0];
      // start at the item BEFORE the active one.
      var index = (index < 0) ? active-1 : length-1;
      // now run through adding the ordinals
      while ( ordinal < length ) {
          // add 1 to the ordinal - ordinal cannot be 0.
          ordinal++;
          //change box ordinal group property
          items.children[index].style[boxOrdinalGroup] = ordinal;
          // go back to start if end is reached
          if ( index < length-1 ) { index++; } else { index = 0; }
      }
  }

});
