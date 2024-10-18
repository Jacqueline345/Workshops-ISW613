<?php
$temperature = array(78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73);

//Calcula el promedio de estas temperaturas
$calculo = array_sum($temperature) / count($temperature);

echo "La temperatura promedio es: " . round($calculo, 1) . "<br>";

//Acomoda el array para que los numeros repetidos no salgan
$temperatura_unica = array_unique($temperature);

//ordena las temperaturas de menor a mayor
sort($temperatura_unica);

//Solo va a incluir las temperaturas bajas
$baja = array_splice($temperatura_unica, 0, 5);

//recorre el array para dar las temperaturas mas bajas que encuentre sin repetirse
echo "Las 5 temperaturas mas bajas son: " . implode(", ", $baja) . "<br>";

//Solo va a incluir las temperaturas altas
$alta = array_slice($temperatura_unica, -5);

//recorre el array para dar las temperaturas mas altas que encuentre sin repetirse
echo "Las 5 temperaturas mas altas son: " . implode(", ", $alta) . "<br>";
?>