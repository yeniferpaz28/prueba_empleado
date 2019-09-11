// datos obtenidos de rol
var arrayCheck = new Array;
function funciones(elemento){

    var elemento = ($(elemento).attr("value"));
    var id_empleado = $('#id_empleado').val();
      
    if(elemento.length>0){
      var checkEnOn = elemento;
 var indice = arrayCheck.indexOf(checkEnOn);
      console.log("El elemento buscado está en el índice ", indice);
      if(indice >= 0){
        console.log("no se puede agregar");
        arrayCheck.splice(indice,1);
      }else{
        arrayCheck.push(checkEnOn);
      }
      
      for(var i=0; i<checkEnOn.length;i++){
           console.log(checkEnOn[i]);
      }
      console.log(arrayCheck);
    }     
     // boton actualizar
    if(elemento == 'btn'){
      var elemento = elemento;
      // enviar datos a la funcion enviar
      enviar(arrayCheck,id_empleado);
    }
}
// enviar datos a obtenerRol
function enviar(arrayCheck,id_empleado){
  var valor = arrayCheck;
  var valorId = id_empleado;
  
    $.ajax({
      url:   '../vista/ObtenerRol.php', //archivo que recibe la llamada
      type:  'post', //método de envio
      async: true,
      data:  {arrayCheck:valor,valorId:valorId}, //datos a enviar en json (para mejor lectura)
      success:  function (result) { //Una vez que la llamada fue realiada y procesada por el servidor, el resultado se recibe en 'response'
        $('#resultado').html(result);
      },
      error: function(result){
        $('#resultado').html('se ha producido un error');
      }
    });
}