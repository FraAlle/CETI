<!DOCTYPE html>
<style>
    body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f0fff4;
    color: #2f4f2f;
    margin: 50px;
    }

    h1 {
        color: #1e5631;
    }

    form {
        background-color: #e6f4ea;
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #a3c9a8;
        border-radius: 8px;
        box-shadow: 2px 2px 10px rgba(0, 128, 0, 0.2);
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #a3c9a8;
        border-radius: 4px;
        background-color: #f0fff4;
    }

    input[type="submit"] {
        margin-top: 15px;
        padding: 10px 33px;
        font-size: 16px;
        color: white;
        background-color: #4CAF50;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #388E3C;
    }
    .back-arrow {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 24px;
            text-decoration: none;
            color: #1e5631;
    }
    div {
        padding: 0px 20px;
    }

    .column{
        display: grid;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #388E3C;
        }

</style>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <title>Formulario</title>
    </head>
    <body>
        <a href="index.php" class="back-arrow">←</a>
        <h1>Introduce tus datos</h1>
        <form name= "Formulario"  action="procesar.php" method="POST">
            <div class="form-login-div">
                <label for="email">Correo electronico:</label>
                <input type="text" id="email" name="email" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class = "column">
                <input type="submit" value="Enviar">
                <button class="back-button" onclick="window.location.href='index.php';">Atrás</button>
            </div>
        </form>
    </body>
</html>