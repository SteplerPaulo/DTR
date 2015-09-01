$(document).ready(function () {
  $('.wizard').mousedown(function (event) {
    // attach 3 pieces of data to the #timeline element
    $(this)
      .data('down', true) // a flag indicating the mouse is down
      .data('x', event.clientX) // the current mouse down X coord
      .data('scrollLeft', this.scrollLeft); // the current scroll position
        
    // return false to avoid selecting text and dragging links within the scroll window
    return false;
  }).mouseup(function (event) {
    // on mouse up, cancel the 'down' flag
    $(this).data('down', false);
  }).mousemove(function (event) {
    // if the mouse is down - start the drag effect
    if ($(this).data('down') == true) {
      // this.scrollLeft is the scrollbar caused by the overflowing content
      // the new position is: original scroll position + original mouse down X - new X
      // I'd like to see if anyone can give an example of how to speed up the scroll.
      this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
    }
  }).css({
    'overflow' : 'scroll', // change to hidden for JS users
    'cursor' : '-moz-grab' // add the grab cursor
  });
});
/*
*/

// finally, we want to handle the mouse going out of the browser window and
// it not triggering the mouse up event (because the mouse is still down)
// but it messes up the tracking of the mouse down
$(window).mouseout(function (event) {
  if ($('.wizard').data('down')) {
    try {
      // *try* to get the element the mouse left the window by and if
      // we really did leave the window, then cancel the down flag
      if (event.originalTarget.nodeName == 'BODY' || event.originalTarget.nodeName == 'HTML') {
        $('#timeline').data('down', false);
      }                
    } catch (e) {}
  }
});