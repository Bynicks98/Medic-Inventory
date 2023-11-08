<!DOCTPYE html>
<html>
    <head>
        <title>Login</title>
    </head>
<body>
    <h1> Inicio de sesion</h1>
    <?php

        include_once("conexion.php");
        cconexion::getConexion();
    ?>
    <div>
        <form method="POST" action="registro.php">
            <table>
                <tr>
                    <td>usuario:</td>
                    <td><input type="text" name="txtusuario" placeholder="Ingrese su usuario"></td>
                </tr>
                <tr>
                    <td>contraseña</td>
                    <td><input type="password" name="txtclave"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Ingresar"></td>
                </tr>
            </table>
        </form>
    </div>