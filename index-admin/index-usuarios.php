
<head>
<meta charset="UTF-8">
    <title>Gaming God</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos-usuario.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.6/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <nav>
        <div class="logo">
            <h2><a href="../index-admin/index-admin.html" class="nombre"> GGod </a></h2>
        </div>
        <ul class="navs">
            <li><a href="../index-admin/index-usuarios.php">Usuarios</a></li>
            <li><a href="../index-admin/index-productos.php">Productos</a></li>
            <li><a href="../index-admin/index-pedidos.php">Pedidos </a></li>
            <li><a href="../index-admin/index-seguimiento.php">Seguimento</a></li>
            <li><a href="../index-admin/carrito.php"> 
                
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
                  </svg>

            </a></li>
            <li><a href="../index.html">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-x-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                  </svg>
            
            </a></li>
        </ul>
        <div class="icono">
            <div class="l1"></div>
            <div class="l2"></div>
            <div class="l3"></div>
        </div>
    </nav>
    <script src="../app.js"></script>
<div class="main">
<h1 class="funcion">Tabla de  Usuario</h1>
    <?php 
    $conexion = new mysqli('localhost','root','','ggod');
  
    if($conexion->connect_error){
        echo " error al conectarce a la base de datos ";
        exit;
    }
    
    $select_usuarios ="SELECT * FROM usuarios";
  
    if(!$resultado = $conexion -> query($select_usuarios)){
        echo "ERROR";
        exit;
    }else{
        echo" <div class='tab'><table class='tablau'><th>ID</th><th>Empresa</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Contraseña</th><th>Cel</th><th>Direccion</th><th>Rol</th><th>Fecha de ingreso</th>";
        while($array_usuarios =$resultado->fetch_assoc()){
              echo"<tr>";
              echo"<td>".$array_usuarios['id_usuario']."</td><td>".$array_usuarios['gg']."</td><td>".$array_usuarios['nombre']."</td><td>".$array_usuarios['apellido']."</td><td>".$array_usuarios['email']."</td><td>".$array_usuarios['contrasena']."</td><td>".$array_usuarios['cel']."</td><td>".$array_usuarios['direccion']."</td><td>".$array_usuarios['rol']."</td><td>".$array_usuarios['fecha_ingreso']."</td>";
              echo"</tr>";
        }
        echo"</table></div>";
      }
      
  
        if(isset($_POST['guardar'])){


          $valor1 = $_POST['nombres'];
          $valor2 = $_POST['apellidos'];
          $valor3 = $_POST['correo'];
          $valor4 = $_POST['contraseña'];
          $valor5 = $_POST['celular'];
          $valor6 = $_POST['direccion'];
          $valor7 = $_POST['rol'];
          $sql = "INSERT INTO usuarios(gg,nombre, apellido, email, contrasena, cel, direccion, rol) VALUES ('1100','$valor1','$valor2','$valor3','$valor4','$valor5','$valor6','$valor7')";
          if (($valor1!= "") and ($valor2!= "") and ($valor3!= "") and ($valor4!= "") and ($valor5!= "") and ($valor6!= "") and ($valor7!= "")){
               if (!$conexion -> query($sql)){
                  echo "<script>alert('Lo sentimos, no se puede realizar el alta en la BD');</script>";
                   exit;
               }else{
                  header('location:index-usuarios.php');
              }
                   $conexion ->close();
          }else{
              echo "<script>alert('No se puede guardar el campo vacio');</script>";
              }
        }
  
          if(isset($_POST['boton_eliminar'])){
            $codEl= $_POST['carga_usuarios_el'];
            $consultaEliminar="DELETE FROM usuarios WHERE id_usuario='$codEl'";
            if($codEl!=""){
              if (!$conexion->query($consultaEliminar)){
                echo "Lo sentimos, no se puede eliminar el registro";
                exit;
              }else{
                echo "<script>alert('Se elimino el registro');</script>";
                header('location:index-usuarios.php');
              }
              
            }else{
              echo "<script>alert('No se puede eliminar sin seleccionar del combo');</script>";
            }
            
          }
  
          if(isset($_POST['boton_modificar'])){
            $id_usuario = $_POST['carga_usuarios_mod'];
            $valornom = $_POST['nombres1'];
            $valorape = $_POST['apellidos1'];
            $valorcor= $_POST['correo1'];
            $valorcon = $_POST['contraseña1'];
            $valorcel = $_POST['celular1'];
            $valordir= $_POST['direccion1'];
            $valorrol = $_POST['rol1'];
            $sql1 ="UPDATE usuarios SET nombre='$valornom', apellido='$valorape',email='$valorcor', contrasena='$valorcon', cel='$valorcel', direccion='$valordir', rol=' $valorrol' WHERE id_usuario ='$id_usuario'";
            if (($valornom!= "") and ($valorape!= "") and ($valorcor!= "") and ($valorcon!= "") and ($valorcel!= "") and ($valordir!= "") and ($valorrol!= "")){
              if (!$conexion -> query($sql1)){
                 echo "<script>alert('Lo sentimos, no se puede realizar la modificacion en la BD');</script>";
                  exit;
              }else{
                 header('location:index-usuarios.php');
             }
                  $conexion ->close();
         }else{
             echo "<script>alert('No se puede guardar el campo vacio');</script>";
             }
         }
          
   ?>
  
  
  <form  class="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <h1 class="funcion">Crear Usuario</h1>
    <section class="form-register">
      <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
      <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
      <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
      <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña">
      <input class="controls" type="number" name="celular" id="celular" placeholder="Ingrese su celular">
      <input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese su direccion">
      <select class="controls" name="rol">
                          <option value="1"> Cliente</option>
                          <option value="2"> Empleado</option>
                          <option value="3"> Admin</option>
                      
      </select>
      <input class="controls" type="date" name="fecha" id="fecha" >
      <input class="botons" type="submit" name="guardar" value="Crear usuario">
      
      <br><br>
      <h1 class="funcion">Eliminar Usuario</h1>
      <?php
          
              if(!$resutadoConsCombo = $conexion -> query($select_usuarios)){
                  echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                  exit;
              }else{
                  echo "<select class='controls' name='carga_usuarios_el'><option></option>";
                  while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                      echo "<option value=".$array_registro['id_usuario'].">".$array_registro['nombre']."</option>";
                  }
                  echo "</select>";
              }
          ?>
              <input type="submit" class='botons' name="boton_eliminar" value="Eliminar usuario">
          <br><br>
        <h1 class="funcion">Modificar Usuario</h1>
        <?php
          
              if(!$resutadoConsCombo = $conexion -> query($select_usuarios)){
                  echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                  exit;
              }else{
                  echo "<select  class='controls' name='carga_usuarios_mod'><option></option>";
                  while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                      echo "<option value=".$array_registro['id_usuario'].">".$array_registro['nombre']."</option>";
                  }
                  echo "</select>";
        }
        
          ?>
          
      <input class="controls" type="text" name="nombres1" id="nombres" placeholder="Ingrese su Nombre">
      <input class="controls" type="text" name="apellidos1" id="apellidos" placeholder="Ingrese su Apellido">
      <input class="controls" type="email" name="correo1" id="correo" placeholder="Ingrese su Correo">
      <input class="controls" type="password" name="contraseña1" id="contraseña" placeholder="Ingrese su Contraseña">
      <input class="controls" type="number" name="celular1" id="celular" placeholder="Ingrese su celular">
      <input class="controls" type="text" name="direccion1" id="direccion" placeholder="Ingrese su direccion">
      <select class="controls" name="rol1">
                          <option value="1"> Cliente</option>
                          <option value="2"> Empleado</option>
                          <option value="3"> Admin</option>
                      
      </select>
      <input class="controls" type="date" name="fecha1" id="fecha" >
          <input type="submit"  class="botons" name="boton_modificar" value="Modificar usuario">
     

        <h1 class="funcion">Buscar Usuario</h1>
            <input class="controls" type="text" name="buscar" placeholder="Ingrese un nombre de usuario" >
            <input type="submit"  class="botons" name="boton_buscar" value="Buscar usuario">
    </section>  
  </form>
  <?php 
  
  if(isset($_POST['boton_buscar'])){
   
    $buscar = $_POST['buscar'];

    $sqlbuscar ="SELECT * FROM usuarios WHERE nombre ='$buscar'";
 
    if(!$res = $conexion -> query($sqlbuscar)){
        echo "ERROR";
        exit;
    }else{
        echo" <div class='tab'><table class='tablau'><th>ID</th><th>Empresa</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Contraseña</th><th>Cel</th><th>Direccion</th><th>Rol</th><th>Fecha de ingreso</th>";
        while($array_buscar =$res->fetch_assoc()){
              echo"<tr>";
              echo"<td>".$array_buscar['id_usuario']."</td><td>".$array_buscar['gg']."</td><td>".$array_buscar['nombre']."</td><td>".$array_buscar['apellido']."</td><td>".$array_buscar['email']."</td><td>".$array_buscar['contrasena']."</td><td>".$array_buscar['cel']."</td><td>".$array_buscar['direccion']."</td><td>".$array_buscar['rol']."</td><td>".$array_buscar['fecha_ingreso']."</td>";
              echo"</tr>";
        }
        echo"</table></div>";
      }

    }
    
  
  ?>
  
</div>
    <footer class="contacto">
         <div class="contenedor-footer">
            <div class="social-media" >
                    <a href="https://www.instagram.com/lbenjal/" class="iconos"><i class='bx bxl-instagram'></i></a>
                    <a href="https://twitter.com/HyperXLatam" class="iconos"><i class='bx bxl-twitter' ></i></a>
                    <a href="https://www.facebook.com/HyperXLATAM" class="iconos"><i class='bx bxl-facebook-circle' ></i></a>
            </div>
        </div>
    <div class="final"></div>
    </footer>
</body>
</html>