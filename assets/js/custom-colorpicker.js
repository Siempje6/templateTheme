jQuery(document).ready(function($){
    $('.iris-palette').hover(function(){
        $(this).css('transform','scale(1.2)');
    }, function(){
        $(this).css('transform','scale(1)');
    });
});
