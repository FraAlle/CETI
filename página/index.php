<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CETI PPS</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: flex-start; 
                height: 100vh;
                background-color: #f4f4f9;
                padding-top: 30px;
            }
            .container {
                text-align: center;
                width: 100%;
                max-width: 800px;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }
            header {
                font-size: 36px;
                font-weight: bold;
                color: #4CAF50;
                margin-top: 0px; 
                margin-bottom: 20px;
            }
            .buttons {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
            }
            .button {
                background-color:rgb(10, 68, 12);
                color: white;
                font-size: 18px;
                padding: 15px 25px;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s;
            }
            .button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>CETI PPS</header>
            <div class="buttons">
                <a href="login.php" class="button">Inicio de Sesión</a>
                <a href="registro.php" class="button">Registro</a>
                <a href="quienes.php" class="button">¿Quiénes Somos?</a>
                <a href="contacto.php" class="button">Contacto</a>
            </div>
        </div>
    </body>
</html>