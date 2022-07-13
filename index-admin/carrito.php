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
<?php

$conexion = new mysqli('localhost','root','','ggod');
  
    if($conexion->connect_error){
        echo " error al conectarce a la base de datos ";
        exit;
    }




echo"<h1 class='funcion'> Productos</h1>";

$select_productos ="SELECT nombre,precio,cantidad FROM productos";
  
if(!$resultado = $conexion -> query($select_productos)){
    echo "ERROR";
    exit;
}else{
    echo" <div class='tab'><table class='tablau'><th>Nombre</th><th>Precio</th><th>Cantidad</th>";
    while($array_productos =$resultado->fetch_assoc()){
          echo"<tr>";
          echo"<td>".$array_productos['nombre']."</td><td>".$array_productos['precio']."</td><td>".$array_productos['cantidad']."</td>";
          echo"</tr>";
    }
    echo"</table></div>";
  }

    $bool= false;
    if(isset($_POST['guardar'])){
            
            $email = $_POST['correo'];
            $direccion_envio = $_POST['direccion'];
            $fecha_envio = $_POST['fecha'];
            $prod_compra =$_POST['carga_producto_carrito'];
            $cant= $_POST['cantidad_p'];

            if (($email!= "") and ($direccion_envio!= "") and ($fecha_envio!= "") and ($prod_compra!= "") and ($cant!= "")){
                $bool= true;
                 $sql = "SELECT id_usuario FROM usuarios WHERE email='$email'";
            
            if($resulta = $conexion->query($sql)){
                while($array = $resulta->fetch_assoc()){
                    $id_usuario = $array['id_usuario'];
                }
            }
            
            $sql2="INSERT INTO pedidos(id_usuario,cantidad, Fecha, direccion_pedido, estado) VALUES ('$id_usuario','$cant','$fecha_envio','$direccion_envio','Solicitando')";
            $resulta = $conexion->query($sql2);


            $sqlpedido = "SELECT id_pedido FROM pedidos WHERE id_usuario='$id_usuario'";
            if($resulta2 = $conexion->query($sqlpedido)){
                while($array2 = $resulta2->fetch_assoc()){
                    $id_pedido = $array2['id_pedido'];
                }
            }

            
            $sqlcarrito="INSERT INTO pedidos_tiene (id_pedido, id_producto, id_usuario) VALUES ('$id_pedido','$prod_compra','$id_usuario')";
            $resultacar = $conexion->query($sqlcarrito);

        }else{
            echo "<script>alert('No se puede guardar el campo vacio');</script>";
        }
    } 

    ?>


    <form  class="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <section class="form-register">
    <h5 class="funcion">ingrece correo, direccion del envio y fecha aprximadad de entrega se restringe a condiciones</h5>
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese su direccion del envio">
    <input class="controls" type="date" name="fecha"  placeholder="Ingrese su fecha aproximada del envio" >
    
    <h5 class="funcion">Elige el producto </h5>
          <?php
              $select_productos2 ="SELECT id_producto,nombre FROM productos";
                  if(!$resutadoConsCombo = $conexion -> query($select_productos2)){
                      echo "Lo sentimos, no se pudo realizar un listado de las peliculas";
                      exit;
                  }else{
                      echo "<select class='controls' name='carga_producto_carrito'><option></option>";
                      while ($array_registro = $resutadoConsCombo -> fetch_assoc()){
                          echo "<option value=".$array_registro['id_producto'].">".$array_registro['nombre']."</option>";
                      }
                      echo "</select>";
                  }
              ?>
    <input class="controls" type="number" name="cantidad_p" placeholder="Ingrese cantidad">
    <input class="botons" type="submit" name="guardar" value="Comprar">
    </section>
    </form>
        <?php
                    if($bool){
                        echo"<h1 class='funcion'>Mis compras </h1>";
                        $select_pedidos ="SELECT id_pedido,id_producto FROM pedidos_tiene WHERE id_usuario ='$id_usuario'";
                      
                        if(!$resultado = $conexion -> query($select_pedidos)){
                            echo "ERROR";
                            exit;
                        }else{
                            echo" <div class='tab'><table class='tablau'><tr><th>ID Pedido</th><th>ID Producto</th></tr>";
                            while($array_pedidos1 =$resultado->fetch_assoc()){
                                $id_prod= $array_pedidos1['id_producto'];
                                
                                $sql1 = "SELECT nombre FROM productos WHERE id_producto='$id_prod'";  
                               
                                if($result = $conexion->query($sql1)){
                                    while(($array_pedidos =  $result->fetch_assoc())){
                                        echo"<tr>";
                                        echo"<td>".$array_pedidos1['id_pedido']."</td><td>".$array_pedidos['nombre']."</td>";
                                        echo"</tr>";
                                
                                    
                                    }
                               
                            }
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