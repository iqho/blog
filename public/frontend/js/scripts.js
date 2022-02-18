
// Navigation Searchbar Script
$(document).ready(function(){
    var submitIcon = $('.searchbox-icon');
    var inputBox = $('.searchbox-input');
    var searchBox = $('.searchbox');
    var isOpen = false;
    submitIcon.click(function(){
    if(isOpen == false){
    searchBox.addClass('searchbox-open');
    inputBox.focus();
    isOpen = true;
    } else {
    searchBox.removeClass('searchbox-open');
    inputBox.focusout();
    isOpen = false;
    }
    });
    submitIcon.mouseup(function(){
    return false;
    });
    searchBox.mouseup(function(){
    return false;
    });
    $(document).mouseup(function(){
    if(isOpen == true){
    $('.searchbox-icon').css('display','block');
    submitIcon.click();
    }
    });
    });

    // Carousel Swipe by Touch
    $(".carousel").on("touchstart", function(event){
    var xClick = event.originalEvent.touches[0].pageX;
    $(this).one("touchmove", function(event){
        var xMove = event.originalEvent.touches[0].pageX;
        if( Math.floor(xClick - xMove) > 5 ){
            $(".carousel").carousel('next');
        }
        else if( Math.floor(xClick - xMove) < -5 ){
            $(".carousel").carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
         $(this).off("touchmove");
        });
    });
