function redirectToDefault()
{
  window.location = "https://encrypted.google.com/";
}

function dataReceived(postResponse)
{
    console.log("dataReceived(): "+postResponse);
    //$("#divContenido:visible").show();
    postResponse = jQuery.parseJSON(postResponse);
    console.log(postResponse);
    if(!postResponse.valid){
        console.log("postResponse.valid not valid");        
        redirectToDefault();        
    }
    $("#divContenido").show();
    $('#descriptionField').html(postResponse.descripcion);  
    $('#distanceDescriptionField').html(postResponse.distanceDescription);  
    $("#imageField").attr("src",postResponse.imageURL);
    //document.getElementById("descriptionField").innerHTML = postResponse.descripcion;
    var locationButton = $("#locationButton");
    var webLinkButton = $("#webLinkButton");
    var shareLinkButton = $("#shareLinkButton");
    locationButton.click( function(){
        window.open("http://maps.google.com/?ll="+postResponse.coordX+","+postResponse.coordY);
    });
    webLinkButton.click( function(){
        window.open(postResponse.webLink);
    });
    shareLinkButton.click( function(){
        
        
//        var shareTitle = encodeURIComponent('');
//        var shareSummary = encodeURIComponent(postResponse.descripcion);
//        var shareUrl = encodeURIComponent(postResponse.shareLink);
//        var shareImage = encodeURIComponent(postResponse.imageURL);
//        window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=' + shareTitle + '&amp;p[summary]=' + shareSummary + '&amp;p[url]=' + shareUrl + '&amp;p[images][0]=' + shareImage,'sharer','toolbar=0,status=0,width=548,height=325');
//        
        FB.ui({
            method: 'feed',
            link: postResponse.shareLink,
            caption: postResponse.descripcion,
          }, function(response){});
        
        
    });
    console.log("FIN");
}   

function dataNotReceived(errorInfo)
{
    console.log("dataNotReceived");
    //console.log(errorInfo);
    //redirectToDefault();
}

function positionReaded(position)
{

    var postArgs = new Object();
    postArgs.coordX = position.coords.latitude.toString();
    postArgs.coordY = position.coords.longitude.toString();
    console.log("sending post");
    var postRequest = $.post( 
            "getAd.php", 
            postArgs,
            dataReceived
    ).fail(dataNotReceived);
    /*
    $.ajax({
        type: "POST",
        url: "getAd.php",
        dataType: 'json',
        data : postArgs
    }).done(dataReceived).fail(dataNotReceived);
    */
    console.log("post sent");
}

function positionNotReaded(error)
{
    console.log("positionNotReaded"+error);
    redirectToDefault();
}

$( document ).ready(function() {
    console.log( "ready!" );
    console.log(jQuery.fn.jquery);
    $("#divContenido").hide();
     if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(positionReaded, positionNotReaded);
    }
    else{
        console.log("not navigator.geolocation");
        redirectToDefault();
    }
});
