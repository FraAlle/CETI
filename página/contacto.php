<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            text-align: center;
        }
        .contacto {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #e6f4ea;
        }
        header{
            font-size: 36px;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 0px; 
            margin-bottom: 20px;
        }
        h2 {
            color: #1e5631; 
        }

        p {
            font-size: 16px;
            line-height: 1.5;
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
</head>
<body>
    <div class="contacto">
        
        <header>Datos de Contacto</header>
        <p><strong>Nombre:</strong> DevSecOps</p>
        <p><strong>Teléfono:</strong> +34 666 666 666</p>
        <p><strong>Email:</strong> devsecops@ceti.es</p>
        <p><strong>Dirección:</strong> Avinguda de l'Advocat Fausto Caruana, 46500 Sagunt, Valencia</p>
    </div>
    <button class="back-button" onclick="window.location.href='index.php';">Atrás</button>
</body>
</html>
