

function dataReceived(postResponse)
{
    console.log("Respuesta acceso: "+postResponse);
    postResponse = jQuery.parseJSON(postResponse);
    if(!postResponse.valid){
        console.log("Acceso DENEGADO");
        mostrarMensaje("Acceso denegado");  
    }else{
        console.log("Acceso CONCEDIDO");
        $.mobile.changePage( "#paginaOperaciones");
    }
    
}  

function dataNotReceived(errorInfo)
{
    mostrarMensaje("No se puede conectar con el servidor");
}
var posX = "0.0";
var posY = "0.0";
var positionReaded = false;

function positionReadedCB(position)
{
    console.log("Posición leída");
    positionReaded = true;
    posX = ""+position.coords.latitude;
    posY = ""+position.coords.longitude;
    
    
};


function positionNotReadedCB(error)
{
    mostrarMensaje("Posición no leída");
};

$( document ).ready(function() {
    
    adminBaseInit();
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(
                positionReadedCB, 
                positionNotReadedCB
        );
    }
    else{
        console.log("not navigator.geolocation");
    }
    $("#botonAcceder").click(function( event ) {
        event.preventDefault();
        var args = new Object();
        args.email = $("#email").val();
        args.password = $("#password").val();
        console.log("Enviando post 'acceder'");
        var postRequest = $.post( 
                "acceder.php", 
                args,
                dataReceived
        ).fail(dataNotReceived);
    });
    $("#botonAgregarAvisos").click(function( event ) {
        $.mobile.changePage( "#paginaAgregarAnuncio");
    });
    
});