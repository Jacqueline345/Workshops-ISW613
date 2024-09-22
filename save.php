<?php
include("con_db.php");
if (isset($_POST["register"])) {
    if(strlen($_POST["name"]) >= 1 && strlen($_POST["lastname"]) >= 1 && strlen($_POST["phone"]) >= 1 && strlen($_POST["email"]) >= 1) {
        $name = trim($_POST["name"]);
        $lastname = trim($_POST["lastname"]);
        $phone = trim($_POST["phone"]);
        $email = trim($_POST["email"]);
        $consulta = "INSERT INTO formulario(nombre,apellido,telefono,email) VALUES('$name', '$lastname', '$phone', '$email')";
        $result = mysqli_query($conex, $consulta);
        if($result){
            ?>
            <h3 class="ok"> ¡Te has agregado correctamente! </h3>
            <?php
        } else{
            ?>
            <h3 class="bad"> ¡Ups ha ocurrido un error! </h3>
            <?php
        }
    }else{
        ?>
        <h3 class="bad"> ¡Por favor complete los campos! </h3>
        <?php 
    }

}


?>