<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
     <title>CETI PPS</title>
     <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="cajafuera">
    <div class="formulariocaja">
        <div class="botondeintercambiar">
            <div id="btnvai"></div>
             <button type="button" class="botoncambiarcaja" onclick="loginvai()">Login</button>
             <button type="button" class="botoncambiarcaja" onclick="registrarvai()">Registrar</button>
		</div>
        <div class="logovai">
            <img src="logo.png">
        </div>
		<!--Formulario para el login -->
        <form id="frmlogin" class="grupo-entradas" method="POST" action="login_registrar.php">
        <input type="text" class="cajaentradatexto" placeholder="&#128273; Ingresar usuario" name="txtusuario" required>
        <input type="password" class="cajaentradatexto" placeholder="&#128274; Ingresar contraseña" name="txtpassword" required>
        <input type="checkbox" class="checkboxvai"><span>Recordar contraseña</span>
        <button type="submit" class="botonenviar" name="btnloginx">Iniciar sesión</button>
        </form>
		<!--Formulario para registrar -->
        <form id="frmregistrar" class="grupo-entradas" method="POST" action="login_registrar.php">
        <input type="text" class="cajaentradatexto" placeholder="&#128273 Ingresar usuario" required 
		name="txtusuario">
        <input type="password" class="cajaentradatexto" placeholder="&#128274 Ingresar contraseña" required name="txtpassword">
        <input type="checkbox" class="checkboxvai"><span>He leído y acepto los términos y condiciones de uso.</span>
        <button type="submit" class="botonenviar" name="btnregistrarx">Registrar</button>
        </form>
        </div>
    </div>
    <script>
    var x = document.getElementById("frmlogin");
    var y = document.getElementById("frmregistrar");
    var z = document.getElementById("btnvai");
        
        function registrarvai(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
            function loginvai(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>
</body>
</html>