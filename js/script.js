$(document).ready(function() { // make sure the page is ready for jquery

    // this is a one line comment

    /* this is
    a multi line comment */

    $('#vote_button').click(function(event) {  // when the submit button gets clicked

        if ($("input:checked").length == 0) {  // if the there are no inputs that are checked
            event.preventDefault(); // stop the functionality of the click on the submit button
            alert('You need to select a movie'); // tell the user
        }

    });

    // add additional javascript here
    $('.poster').click(function () {
      /* everything inside here only
      happens after the click */
      $('.poster').css('border-color','white'); //reset border color to white

      $('.poster').css('height','150px');
      $('.poster').css('margin-bottom', '20px');
      $('.poster').css('margin-top','20px');

      $(this).css('border-color','red') //apply red border to the poster that has been clicked.

      $(this).animate({
        'height':'180px',
        'margin-top': '10px',
        'margin-bottom': '0'
      });
    });

});
