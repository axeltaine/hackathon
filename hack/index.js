$( "#btnstart" ).click(function() {
    $("h2").hide();
    $("h1").hide();
    $("#btnstart").hide();
    $(".block").css('padding = 0px');
    gameStarted = true;
    navigator.geolocation.getCurrentPosition(geoSuccess, geoFail);
    
  $("#map").slideDown(function() {
    var resizeEvent = new Event('resize');
    window.dispatchEvent(resizeEvent);
  });
});


