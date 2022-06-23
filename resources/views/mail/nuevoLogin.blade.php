<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo inicio de sesión</title>
</head>

<body style="font-family: Arial; margin: 1em;">
    <div
        style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
        <div
            style="width: 30em; color:white; background-color: #2a9d8f; padding-right: 2em; padding-left: 2em; padding-top:1em; padding-bottom:1em; border-radius: 10px; text-align: justify; margin: 1em;">
            <img src="{{ url(Storage::url('img/logo.png')) }}" alt="logo" style="width: 100%;">
            <p><b>Hola {{ $usuario->name }} ,</b></p>
            <p>Hemos detectado un inicio de sesión desde un equipo o red distinta a la de tu último inicio de sesión.
            </p>
            <p>Si has sido tú, puedes ignorar este mensaje, de lo contrario, te recomendamos que entres en tu cuenta y
                cambies la contraseña, al cambiarla se cerrarán todas las sesiones en cualquier ordenador.</p>

            <p>Si tienes cualquier problema, no dudes en contactar con el equipo de soporte <a
                    href="mailto:soporte@mijikonetwork.com">soporte@mijikonetwork.com</a></p>

            <p>Gracias por confiar en Gestrón</p>

            <p style="margin-top: 1em; text-align:center">Copyright - Gestrón 2022</p>
        </div>
    </div>
</body>

</html>
