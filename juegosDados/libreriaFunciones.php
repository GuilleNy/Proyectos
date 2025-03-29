<?php


$jugador1=$_POST['jug1'];
$jugador2=$_POST['jug2'];
$jugador3=$_POST['jug3'];
$jugador4=$_POST['jug4'];
$numDados=$_POST['numdados'];


$filtroJugadores= array_filter([$jugador1,$jugador2,$jugador3,$jugador4]);

function numMaximoJugadores($filtroJugadores)
{
    $enviar=true;
    $numerosDeJugadores=count($filtroJugadores);

    if($numerosDeJugadores < 2 || $numerosDeJugadores >4 ){
        $enviar=false;
    }
    return $enviar;
}
/************************************************************************************************ */
function numMaximoDados($numDados)
{
    $enviar=true;
    if($numDados < 1 || $numDados > 10){
        $enviar=false;
    }
    return $enviar;
}

try{
    if(isset($_POST['tirar'])){
        if (!numMaximoJugadores($filtroJugadores)){
           throw new Exception("El número de jugadores debe ser mínimo 2 y máximo 4.");
        }
        if (!numMaximoDados($numDados)){
            throw new Exception("El numero de dados debe de ser minimo de 1 y como maximo de 10.");
        }

    }

    // Inicializar el array con valores vacios.

    $jugadores=[];

    foreach ($filtroJugadores as $nombre) {
        $jugadores[$nombre]=[];
    }

    function llenarDados(&$nombre, $numDados){
        for ($i=0; $i < $numDados; $i++) { 
            $nombre[]=rand(1,6);
        }
    }

  /************************************************************************************************ */


    foreach ($jugadores as &$nombre ) {
        
       llenarDados($nombre, $numDados);
    }
    
    //var_dump($jugadores);

/************************************************************************************************ */

    function visualizarTabla($jugadores){
        echo "<table border='1'>";
       
        foreach($jugadores as $nombre => $dados){
            
            echo "<tr>";
            echo "<td>" . $nombre . "</td>";
            foreach ($dados as $dado) {
                echo "<td><img src='images/$dado.png' width='100px' height='100px'></td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    }
/************************************************************************************************ */


    function sumarPuntos($jugadores, $numDados){
        $sumaJugadores=[];

        foreach($jugadores as $nombre => $dados){
            //array_unique() devuelve un array con los valores únicos de un array
            //count() devuelve el número de elementos en un array
            //array_sum() devuelve la suma de los valores de un array
            //count(array_unique($dados))== 1 significa que todos los dados son iguales
            if(count(array_unique($dados))== 1 && $numDados > 2)
            {
                $sumaJugadores[$nombre]=100;
            }else{
                $sumaJugadores[$nombre]=array_sum($dados);
            }
        }
        return $sumaJugadores;
    }
/************************************************************************************************ */

    function visualizarPuntos($jugadores, $numDados)
    {
        $arrayPuntos= sumarPuntos($jugadores, $numDados);
        foreach($arrayPuntos as $nombre => $puntos )
        {
            echo $nombre . " =" . $puntos . "<br>";
            
        }
    }
/************************************************************************************************ */

    function ganador($jugadores, $numDados){

        $sumJuga= sumarPuntos($jugadores, $numDados);
        $maximo= max($sumJuga);
        $contadorGanadores=0;

        foreach ($sumJuga as $nombre => $dado) {
            if($dado == $maximo){
                echo "GANADOR: " . $nombre . "<br>";
                $contadorGanadores++;
            }
        }
        echo "NUMERO GANADORES: " . $contadorGanadores;
    }


    echo "<h2>RESULTADO JUEGO DADOS</h2>";

    visualizarTabla($jugadores);

    visualizarPuntos($jugadores, $numDados);

    ganador($jugadores, $numDados);


}catch(Exception $e){
    echo $e->getMessage();
}






?>