$(function()
 {
    var $blocks = $('.animatedBlock.notViewed');// Get all blocks that are going to be affected by the scroll view animation.
    var $window = $(window);// Window object.
    
    $window.on('scroll', function(e)
    {
        // Iterate through each element and check if element has been animated into view.
        $blocks.each(function(i, elem)
        {
            // If the element has been animated, skip it.
            if($(this).hasClass('viewed'))
                return;
            
            // If the element has not been animated, animate it.
            isScrolledIntoView($(this));
        });
    });
});

function isScrolledIntoView(elem)
{
    var docViewTop    = $(window).scrollTop(); // Top of window (viewport)
    var docViewBottom = docViewTop + $(window).height(); // Bottom of window (viewport)
    var elemOffset    = 0; // Checks data attribute (data-offset) of element to check if any offset exists.
    
    if(elem.data('offset') != undefined)
    {
        elemOffset = elem.data('offset');
    }
    
    var elemTop    = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    
    if (elemOffset != 0)
    {
        // Custom offset is updated based on scrolling direction
        if(docViewTop - elemTop >= 0)
        {
            // Scrolling up from bottom
            elemTop = $(elem).offset().top + elemOffset;
        }
        else
        {
            // Scrolling down from top
            elemBottom = elemTop + $(elem).height() - elemOffset;
        }
    }
    
    if((elemBottom <= docViewBottom) && (elemTop >= docViewTop))
    {
        // Once an element is visible exchange the classes
        $(elem).removeClass('notViewed').addClass('viewed');
        
        
        var animElemsLeft = $('.animatedBlock.notViewed').length;
        if(animElemsLeft == 0)
        {
            // With no animated elements left, debind the scroll event
            $(window).off('scroll');
        }
        
    }
}