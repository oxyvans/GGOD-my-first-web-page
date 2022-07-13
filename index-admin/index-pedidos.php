<head>
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
    <h1 class="funcion">Todos los Pedidos</h1>
    <div class="main">
    
        <?php 
        $conexion = new mysqli('localhost','root','','ggod');
      
        if($conexion->connect_error){
            echo " error al conectarce a la base de datos ";
            exit;
        }
        
        $select_pedidos ="SELECT * FROM pedidos";
      
        if(!$resultado = $conexion -> query($select_pedidos)){
            echo "ERROR";
            exit;
        }else{
            echo" <div class='tab'><table class='tablau'><th>ID</th><th>ID Usuario</th><th>Fecha</th><th>Direccion de envio</th><th>estado</th>";
            while($array_pedidos =$resultado->fetch_assoc()){
                  echo"<tr>";
                  echo"<td>".$array_pedidos['id_pedido']."</td><td>".$array_pedidos['id_usuario']."</td><td>".$array_pedidos['Fecha']."</td><td>".$array_pedidos['direccion_pedido']."</td><td>".$array_pedidos['Estado']."</td>";
                  echo"</tr>";
            }
            echo"</table></div>";
          }


          if(isset($_POST['boton_eliminar'])){

            $codEl= $_POST['carga_pedido_el'];

            $consultaEliminar2="DELETE FROM pedidos_tiene WHERE id_pedido='$codEl'";
            $consultaEliminar="DELETE FROM pedidos WHERE id_pedido='$codEl'";
            if($codEl!=""){
              if (!$conexion->query($consultaEliminar)){
                echo "Lo sentimos, no se puede eliminar el registro";
                exit;
              }else{
                $conexion->query($consultaEliminar2);
                echo "<script>alert('Se elimino el registro');</script>";
                header('location:index-pedidos.php');
              }
              
            }else{
              echo "<script>alert('No se puede eliminar sin seleccionar del combo');</script>";
            }
            
          }

          if(isset($_POST['boton_mod'])){
            $id_pedido = $_POST['carga_pedido_mod'];
            $valor = $_POST['estado2'];
            
            $sqlmod ="UPDATE pedidos SET  Estado=' $valor' WHERE id_pedido ='$id_pedido'";
            
            if (($valor!= "")){
              if (!$conexion -> query($sqlmod)){
                 echo "<script>alert('Lo sentimos, no se puede realizar la modificacion en la BD');</script>";
                  exit;
              }else{
                 header('location:index-pedidos.php');
             }
                  $conexion ->close();
         }else{
             echo "<script>alert('No se puede guardar el campo vacio');</script>";
             }
         }






        ?>
    </div>




    <form  class="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <section class="form-register">
    <h1 class="funcion">Modificar Pedido</h1>
    <?php
          
          if(!$resutadoConsCombo2 = $conexion -> query($select_pedidos)){
              echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
              exit;
          }else{
              echo "<select class='controls' name='carga_pedido_mod'><option></option>";
              while ($array_registro2 = $resutadoConsCombo2 -> fetch_assoc()){
                  echo "<option value=".$array_registro2['id_pedido'].">".$array_registro2['id_pedido']."</option>";
              }
              echo "</select>";
          }
      ?>
            <select class="controls" name="estado2">
                          <option value="Solicitando">Solicitando </option>
                          <option value="Recibido"> Recibido </option>
                          <option value="Preparacion"> Preparacion</option>
                          <option value="Enviando"> Enviando</option>
                          <option value="Entregado">Entregado</option>
                          <option value="Cancelada"> Cancelada</option>
                      
            </select>
          <input type="submit" class='botons' name="boton_mod" value="Modificar estado">



    <h1 class="funcion">Eliminar Pedido</h1>
    
      <?php
          
              if(!$resutadoConsCombo = $conexion -> query($select_pedidos)){
                  echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                  exit;
              }else{
                  echo "<select class='controls' name='carga_pedido_el'><option></option>";
                  while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                      echo "<option value=".$array_registro['id_pedido'].">".$array_registro['id_pedido']."</option>";
                  }
                  echo "</select>";
              }
          ?>
              <input type="submit" class='botons' name="boton_eliminar" value="Eliminar Pedido">


    <h1 class="funcion">Info del Pedido</h1>
         <?php
          
              if(!$resutadoConsCombo = $conexion -> query($select_pedidos)){
                  echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                  exit;
              }else{
                  echo "<select class='controls' name='carga_pedido_info'><option></option>";
                  while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                      echo "<option value=".$array_registro['id_pedido'].">".$array_registro['id_pedido']."</option>";
                  }
                  echo "</select>";
              }
        ?>
              <input type="submit" class='botons' name="boton_info" value="Ver info del Pedido">


    <h1 class="funcion">Filtrar Pedido</h1>
              <select class="controls" name="filtrar">
                          <option value="Solicitando">Solicitando </option>
                          <option value="Recibido"> Recibido </option>
                          <option value="Preparacion"> Preparacion</option>
                          <option value="Enviando"> Enviando</option>
                          <option value="Entregado"> Entregado</option>
                          <option value="Cancelada"> Cancelada</option>
                      
      </select>

      <input type="submit" class='botons' name="boton_filtrar" value="Filtrar">
    </form>
    </section>

<?php

if(isset($_POST['boton_info'])){

$codigo_pedido = $_POST['carga_pedido_info'];   

$select_pedidos ="SELECT * FROM pedidos_tiene WHERE id_pedido ='$codigo_pedido'";
    if($codigo_pedido!=""){
        if(!$resultado = $conexion -> query($select_pedidos)){
            echo "ERROR";
            exit;
        }else{
            echo" <div class='tab'><table class='tablau'><tr><th>ID Pedido</th><th>ID Producto</th><th>ID Usuario</th></tr>";
            while($array_pedidos1 =$resultado->fetch_assoc()){
                $id_prod= $array_pedidos1['id_producto'];
                $id_usu= $array_pedidos1['id_usuario'];
                $sql1 = "SELECT nombre FROM productos WHERE id_producto='$id_prod'";  
                $sql2 = "SELECT nombre FROM usuarios WHERE id_usuario='$id_usu'";
                if($result = $conexion->query($sql1) and $result1 = $conexion->query($sql2)){
                    while(($array_pedidos =  $result->fetch_assoc() )and ($array_pedidos2 =  $result1->fetch_assoc() ) ){
                        echo"<tr>";
                        echo"<td>".$array_pedidos1['id_pedido']."</td><td>".$array_pedidos['nombre']."</td><td>".$array_pedidos2['nombre']."</td>";
                        echo"</tr>";
                
                    
                    }
               
            }
            }
           echo"</table></div>";
          }
        }else{
            echo "<script>alert('No se puede mostrar info sin seleccionar del combo');</script>"; 
        }
}

?>

<?php

if(isset($_POST['boton_filtrar'])){

$codigo_pedido1 = $_POST['filtrar'];   

$select_pedidos2 ="SELECT * FROM pedidos WHERE Estado='$codigo_pedido1' ";
if(!$resultado3 = $conexion -> query($select_pedidos2)){
    echo "ERROR";
    exit;
}else{
    echo" <div class='tab'><table class='tablau'><th>ID</th><th>ID Usuario</th><th>Fecha</th><th>Direccion de envio</th><th>estado</th>";
    while($array_pedidos3 =$resultado3->fetch_assoc()){
          echo"<tr>";
          echo"<td>".$array_pedidos3['id_pedido']."</td><td>".$array_pedidos3['id_usuario']."</td><td>".$array_pedidos3['Fecha']."</td><td>".$array_pedidos3['direccion_pedido']."</td><td>".$array_pedidos3['Estado']."</td>";
          echo"</tr>";
    }
    echo"</table></div>";
  }

}

?>





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