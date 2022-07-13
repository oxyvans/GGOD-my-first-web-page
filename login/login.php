<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="estilo-login.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <title>Inicar sesion</title>
</head>
<body>
<?php 
  $conexion = new mysqli('localhost','root','','ggod');

  if($conexion->connect_error){
      echo " error al conectarce a la base de datos ";
      exit;
  }

    if(isset($_POST['guardar'])){
      
      $valor1 = $_POST['correo'];
      $valor2 = $_POST['contraseña'];
      $sql = "SELECT email,contrasena,rol FROM usuarios WHERE email = '$valor1' AND contrasena = '$valor2'";
   
      
      if (($valor1!= "") and ($valor2!= "")){
        if (!$resultado = $conexion -> query($sql)){
           echo "<script>alert('Lo sentimos, datos incorrectos ');</script>";
            exit;
        }else{
          while($array = $resultado->fetch_assoc()){
              if($array['rol']==1){
                header('location:../index-cliente/index-cliente.html');
            }else{
              if($array['rol']==2){
                header('location:../index-empleado/index-empleado.html');
              }else{
                header('location:../index-admin/index-admin.html');
              }
            }

          }
        }
      }else{
          echo "<script>alert('No se puede guardar el campo vacio');</script>";
          }
}

 
 
 
 
 ?>


  <section class="form-register">
    <h4>Iniciar sesion</h4>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
    <input class="controls" type="email" id="correo" name="correo"  placeholder="Ingrese su Correo">
        <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña">
        <input class="botons" type="submit" name="guardar" value="Inicar sesion">
        <p><a href="registrar.php">¿No tengo Cuenta?</a></p>
    </form>

  </section>

</body>
</html>