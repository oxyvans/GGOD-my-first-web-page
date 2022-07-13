<head>
    <title>Gaming God</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos-seguimiento.css" rel="stylesheet" type="text/css">
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
    <div class="final"></div>
    </footer>
</body>
</html>