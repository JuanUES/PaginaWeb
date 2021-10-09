$( window ).on( "load", function() {
    $('#loading').hide();
    setTimeout(function(){$('#loading').remove()},1000);
});  