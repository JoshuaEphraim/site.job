$(document).ready(function() {
    showDomains();
    $('#header .lSide a.trigger').on('click', function(){
        $('#header .menu').slideToggle('fast');
        return false;
    });
});