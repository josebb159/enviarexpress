function login(){
   var usuario = $("#usuario").val();
   var contrasena = $("#contrasena").val();
 
  
   $.post({
        type: 'POST',
        url: 'controller/usuarioController.php',
        data: {'op':'login',
                'correo': usuario,
                 'contrasena': contrasena},
        success: function(response){
            
     
          
            if(response=="1"){
                window.location.href = "view/home.php"; 
            }else if(response=="2"){
                alert("Usuario no permitido en la plataforma");
            }else{
                alert("Usuario incorrecto");
            }
   
           
        }
        });

    
}