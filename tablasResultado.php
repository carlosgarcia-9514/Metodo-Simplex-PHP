<html>
    <head>
        <link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">
        <link href="http://getbootstrap.com/examples/jumbotron/jumbotron.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="icon" type="image/png" href="img/icono.PNG">
        <script>
            function volver_inicio(){
                window.location = "index.php";
            }
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body background="img/fondooss.PNG" style="height: 100%; width: 100%;background-size: 100% ; position: relative">     
        <div class="jumbotron">
            <div class="container">
                <h1>Tablas Simplex</h1>
            </div>
        </div>
        <div class="container">
            <?php


include_once "imprimirTabla.php";
include_once "simplex.php";

//ejecutar simplex
$objeto_simplex = new simplex();
$objeto_simplex->realizar_simplex();

    $tablas_solucion = $_SESSION['tablas_solucion'];
    $CjmZj_solucion = $_SESSION['CjmZj_solucion'];
    $Zj_solucion = $_SESSION['Zj_solucion'];

    imprimirTablas($tablas_solucion, $CjmZj_solucion, $Zj_solucion);

    $ultima_solucion = array_pop($tablas_solucion);
    //Validar si necesita solución entera 

    $solucion_entera = true; 
        for($i = 1; $i<count($ultima_solucion[0]); $i++){
            if (substr($ultima_solucion[0][$i]->variable,0,1) == "X" &&
                floor($ultima_solucion[1][$i]) != $ultima_solucion[1][$i]){
                $solucion_entera = false;
                break;
            }   
        }

        function imprimirTablas($tablas_solucion, $CjmZj_solucion, $Zj_solucion){
            $objeto_impresion = new imprimirTabla();

            for($i = 0; $i < count($tablas_solucion); $i++){
                echo $objeto_impresion->imprimirTablaSolucion($tablas_solucion[$i], $i+1, $Zj_solucion[$i], $CjmZj_solucion[$i]);
            }
        }
?>            
        </div>
        <br>
        <div>
            <button style="background: #006dcc; font-size: 20px;border-radius: 4px; cursor: pointer; color:white;text-decoration:none; border: 1px solid #cccccc;padding: 4px 12px;
    margin-bottom: 0; font-family: time-new roman;display: inline-block" onclick="volver_inicio()">Volver al inicio</button>
        </div> 
        
    </body>
</html>
