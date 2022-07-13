<head>
    <title>Gaming God | Seguimiento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos-seguimiento.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.6/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <nav>
        <div class="logo">
            <h2><a href="../index.html" class="nombre"> GGod </a></h2>
        </div>
        <ul class="navs">
            <li><a href="../productos/index-productos.html">Productos</a></li>
            <li><a href="../contacto/index-contacto.html">Contacto</a></li>
            <li><a href="../seguimiento/index-seguimiento.php">Seguimiento</a></li>
            <li><a href="../carrito/carrito.php">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
                  </svg>


            </a></li>
            <li><a href="../login/login.php">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
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

    if(isset($_POST['seguir'])){

    $valor = $_POST['pedido'];
   
    $sql ="SELECT Estado,Fecha FROM pedidos WHERE id_pedido = '$valor'";

    if ($valor != ""){
        if (!$resultado = $conexion -> query($sql)){
           echo" <div class='alert alert-danger' role='alert'>
           no existe pedido 
         </div>";
            exit;
        }else{
            while($array = $resultado->fetch_assoc()){
                if($array['Estado'] !=''){
                   $estado = $array['Estado'];
                    $fecha =$array['Fecha'];
                    echo "<div class='alert alert-primary' role='alert'>
            Su pedido esta en estado de  $estado   y llega el   $fecha 
                  </div>";
                
            }
        }
    }
   }else{
       echo "<div class='alert alert-warning' role='alert'>
       Campo vacio 
            </div>";
       }
 
    }
    ?>
   
   
   
   
  
        <div class="texto">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input class="controls" type="number" name="pedido"  placeholder="Ingrese ID del Pedido">
            <input class="botons" name="seguir" type="submit" value="Seguir">
        </form>
        </div>
    </div>

    <footer class="contacto">
         <div class="contenedor-footer">
            <div class="social-media" >
                    <a href="https://www.instagram.com/lbenjal/" class="iconos"><i class='bx bxl-instagram'></i></a>
                    <a href="https://twitter.com/HyperXLatam" class="iconos"><i class='bx bxl-twitter' ></i></a>
                    <a href="https://www.facebook.com/HyperXLATAM" class="iconos"><i class='bx bxl-facebook-circle' ></i></a>
            </div>
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