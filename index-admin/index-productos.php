
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
    <h1 class="funcion">Tabla de Productos</h1>
        <?php 
        $conexion = new mysqli('localhost','root','','ggod');
      
        if($conexion->connect_error){
            echo " error al conectarce a la base de datos ";
            exit;
        }
        
        $select_productos ="SELECT * FROM productos";
      
        if(!$resultado = $conexion -> query($select_productos)){
            echo "ERROR";
            exit;
        }else{
            echo" <div class='tab'><table class='tablau'><th>ID</th><th>Empresa</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Categoria</th>";
            while($array_productos =$resultado->fetch_assoc()){
                  echo"<tr>";
                  echo"<td>".$array_productos['id_producto']."</td><td>".$array_productos['gg']."</td><td>".$array_productos['nombre']."</td><td>".$array_productos['precio']."</td><td>".$array_productos['cantidad']."</td><td>".$array_productos['categoria']."</td>";
                  echo"</tr>";
            }
            echo"</table></div>";
          }
          
      
            if(isset($_POST['guardar'])){
    
    
              $valor1 = $_POST['nombre'];
              $valor2 = $_POST['precio'];
              $valor3 = $_POST['cantidad'];
              $valor4 = $_POST['categoria'];

              $sql = "INSERT INTO productos(gg,nombre, precio, cantidad, categoria) VALUES ('1100','$valor1','$valor2','$valor3','$valor4')";
              if (($valor1!= "") and ($valor2!= "") and ($valor3!= "") and ($valor4!= "")){
                   if (!$conexion -> query($sql)){
                      echo "<script>alert('Lo sentimos, no se puede realizar el alta en la BD');</script>";
                       exit;
                   }else{
                      header('location:index-productos.php');
                  }
                       $conexion ->close();
              }else{
                  echo "<script>alert('No se puede guardar el campo vacio');</script>";
                  }
            }
      
              if(isset($_POST['boton_eliminar'])){
                $codEl= $_POST['carga_producto_el'];
                $consultaEliminar="DELETE FROM productos WHERE id_producto='$codEl'";
                if($codEl!=""){
                  if (!$conexion->query($consultaEliminar)){
                    echo "Lo sentimos, no se puede eliminar el registro";
                    exit;
                  }else{
                    echo "<script>alert('Se elimino el registro');</script>";
                    header('location:index-productos.php');
                  }
                  
                }else{
                  echo "<script>alert('No se puede eliminar sin seleccionar del combo');</script>";
                }
                
              }
      
              if(isset($_POST['boton_modificar'])){
                
                $id_producto = $_POST['carga_producto_mod'];
                
                $valornom = $_POST['nombre1'];
                $valorapre = $_POST['precio1'];
                $valorcan= $_POST['cantidad1'];
                $valorcat = $_POST['categoria1'];
                
               
                $sql1 ="UPDATE productos SET nombre='$valornom', precio='$valorapre',cantidad='$valorcan', categoria='$valorcat' WHERE id_producto='$id_producto'";
                if (($valornom!= "") and ($valorapre!= "") and ($valorcan!= "") and ($valorcat!= "")){
                  if (!$conexion -> query($sql1)){
                     echo "<script>alert('Lo sentimos, no se puede realizar la modificacion en la BD');</script>";
                      exit;
                  }else{
                     header('location:index-productos.php');
                 }
                      $conexion ->close();
             }else{
                 echo "<script>alert('No se puede guardar el campo vacio');</script>";
                 }
             }
              
       ?>
      
      
      <form  class="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <h1 class="funcion">Agregar Producto</h1>
        <section class="form-register">
          <input class="controls" type="text" name="nombre" id="nombres" placeholder="Ingrese su Nombre">
          <input class="controls" type="number" name="precio" id="precio" placeholder="Ingrese su Precio">
          <input class="controls" type="number" name="cantidad" id="cantidad" placeholder="Ingrese cantidad del producto">
          <input class="controls" type="text" name="categoria" id="categoria" placeholder="Ingrese categoria">
          
          
         
          <input class="botons" type="submit" name="guardar" value="Agregar Producto">
          
          <br><br>
          <h1 class="funcion">Eliminar Producto</h1>
          <?php
              
                  if(!$resutadoConsCombo = $conexion -> query($select_productos)){
                      echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                      exit;
                  }else{
                      echo "<select class='controls' name='carga_producto_el'><option></option>";
                      while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                          echo "<option value=".$array_registro['id_producto'].">".$array_registro['nombre']."</option>";
                      }
                      echo "</select>";
                  }
              ?>
                  <input type="submit" class='botons' name="boton_eliminar" value="Eliminar Producto">
              <br><br>
            <h1 class="funcion">Modificar Producto</h1>
            <?php
              
                  if(!$resutadoConsCombo = $conexion -> query($select_productos)){
                      echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                      exit;
                  }else{
                      echo "<select  class='controls' name='carga_producto_mod'><option></option>";
                      while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                          echo "<option value=".$array_registro['id_producto'].">".$array_registro['nombre']."</option>";
                      }
                      echo "</select>";
            }
            
            ?>
              
          <input class="controls" type="text" name="nombre1" id="nombres" placeholder="Ingrese su Nombre">
          <input class="controls" type="number" name="precio1" id="precio" placeholder="Ingrese su Precio">
          <input class="controls" type="number" name="cantidad1" id="cantidad" placeholder="Ingrese cantidad del producto">
          <input class="controls" type="text" name="categoria1" id="categoria" placeholder="Ingrese categoria">
        
          <input type="submit"  class="botons" name="boton_modificar" value="Modificar Producto">
      </form>
      
      
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