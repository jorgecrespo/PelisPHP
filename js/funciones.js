
function validar(){

    /*

VALIDACIONES LADO CLIENTE Y LADO SERVIDOR
nombre y apellido:
    -alfabetico

username:
  
    - alfanumerico
clave: 
    
    -al menos un simbolo $ o @ o etc
    -letras mayusculas y minusculas

VALIDACION LADO SERVIDOR   
username:
    -no sea preexistente

*/
    var nombre, apellido, usuario, email, clave, clave2, alfabetico, alfanumerico, tipoclave;

    alfabetico = [A-Za-z];

    nombre = document.getElementById("aunombre").value;
    apellido = document.getElementById("auapellido").value;
    email = document.getElementById("auemail").value;
    usuario = document.getElementById("auusuario").value;
    clave = document.getElementById("auclave").value;
    clave2 = document.getElementById("auclave2").value;

    if (nombre === "" || apellido ==="" || email ==="" || usuario ==="" || clave ==="" || clave2===""){
        alert("Complete todos los campos del formulario");
        return false;
    } else if (clave !== clave2){
        alert("Las contraseñas ingresadas no coinciden.");
        return false;
    } else if (usuario.length<6 || clave.length<6){
        alert("El nombre de usuario y la contraseña deben superar los 6 caracteres.");
        return false;
    }
    else if (!alfabetico.test(nombre) || !alfabetico.test(apellido)){
        alert("Nombre y apellido solo pueden contener caracteres alfabeticos.");
        return false;
    }

return false;
}

