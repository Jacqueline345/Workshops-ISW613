<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Informacion </title>
</head>

<body>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: cornsilk;
            margin: 0;
            padding: 0;
        }

        .form-group {
            padding: 50px;
            text-align: center;
            justify-content: center;
            justify-items: center;
        }

        .btn-primary {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            padding: 15px 32px;
            margin-left: 45%;
            margin-top: 5px;
            text-align: center;
            background-color: #00bfff;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .form-control {
            padding: 5px;
            border-radius: 2px;
        }
    </style>
    <form method="POST">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="name" id="" placeholder="Your name">
            <input type="text" class="form-control" name="lastname" id="" placeholder="Your last name">
            <label for="">Telefono</label>
            <input type="text" class="form-control" name="phone" id="" placeholder="Your phone">
            <label for="">Correo</label>
            <input type="text" class="form-control" name="email" id="" placeholder="Your email">
        </div>
        <button type="submit" class="btn-primary" name="register">Submit</button>
    </form>
    <?php
    include("save.php");
    ?>
</body>

</html>