/**
* Mágicarousel. A flexbox carousel
*
* @author Pablo Bejarano (@Pabhoz)
* @version 1.0.0
*
* Based on the flexbox-carousel by Andi Smit @ https://github.com/andismith
*/
$(function(){

  //global (magicarousel) vars.
  var [container,items,active] = [$("#magicarousel")[0],$("#magicarousel ul")[0],0];
  //use Modernizr.prefixed to get the prefixed version of boxOrdinalGroup
  var boxOrdinalGroup = Modernizr.prefixed( 'boxOrdinalGroup' );

  //init frontal item
  $(items.children[0]).addClass("frontal");

  //Assign listeners to magicarousel childs
  for (var i = 0; i < items.children.length; i++) {
    //on click listener
    $(items.children[i]).click(function(){

      let clicked = $(this).index();
      var direction = -1;
      //if clicked one is the last one (left one at beginning)
      if(clicked == items.children.length-1 && active == 0){
        direction = 1;
        changeOrdinal();
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
      moveIt(direction,active);
    });

  }
  /**
  * @author Pablo Bejarano (@Pabhoz)
  * @desc Recives a direction and new active element to move the margin of carousel items parent
  * to create the movement animation
  * @param direction int between -1 and 1. determines the direction of movement
  * @param newActive int. new active magicarousel element index
  */
  function moveIt(direction,newActive){
    $("#magicarousel .frontal").removeClass("frontal");//remove frontal from old active one
    $(items.children[newActive]).addClass("frontal");//add frontal class to new active one
    //get the computed styles of items parent
    var itemStyle = window.getComputedStyle( items, null ) || items.currentStyle;
    //get the computed margin left of carousel items parent
    let currentMargin = parseInt(itemStyle.marginLeft);
    //get an element of magicarousel who's not the frontal one
    let carrouselItem = $("#magicarousel li:not(.frontal)");
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
  //change the ordinal of carousel to create infinite effect
  changeOrdinal();

  /**
  * @author Andi Smith
  * @modify Pablo Bejarano (@Pabhoz) on 12/02/16
  */
  function changeOrdinal() {
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
