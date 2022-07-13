<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="estilo-regist.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <title>Registrarme</title>
</head>
<body>

<?php 
   $conexion = new mysqli('localhost','root','','ggod2');

   if($conexion->connect_error){
       echo " error al conectarce a la base de datos ";
       exit;
   }else{
    



     if(isset($_POST['guardar'])){
        
      $valor1 = $_POST['nombres'];
      $valor2 = $_POST['apellidos'];
      $valor3 = $_POST['correo'];
      $valor4 = $_POST['contraseña'];
      $valor5 = $_POST['celular'];
      $valor6 = $_POST['direccion'];
      $valor7 = $_POST['rol'];
      $sql = "INSERT INTO usuarios(nombre, apellido, email, contrasena, cel, direccion, rol) VALUES ('$valor1','$valor2','$valor3','$valor4','$valor5','$valor6','$valor7')";
      if (($valor1!= "") and ($valor2!= "") and ($valor3!= "") and ($valor4!= "") and ($valor5!= "") and ($valor6!= "") and ($valor7!= "")){
           if (!$conexion -> query($sql)){
              echo "<script>alert('Lo sentimos, no se puede realizar el alta en la BD');</script>";
               exit;
           }else{
              header('location:login.php');
          }
               $conexion ->close();
      }else{
          echo "<script>alert('No se puede guardar el campo vacio');</script>";
          }
      }
}







 ?>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <section class="form-register">
    <h4>Registrate</h4>
    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
    <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña">
    <input class="controls" type="number" name="celular" id="celular" placeholder="Ingrese su celular">
    <input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese su direccion">
    <select class="controls" name="rol">
						<option value="1"> Cliente</option>
    </select>
    <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
    <input class="botons" type="submit" name="guardar" value="Registrar">
    <p><a href="login.php">Ya tengo Cuenta</a></p>
  </section>
</form>
</body>
</html>