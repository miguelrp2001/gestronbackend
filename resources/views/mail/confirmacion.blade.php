<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nueva alta</title>
</head>


<body style="font-family: Arial; margin: 1em;">
    <div
        style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
        <div
            style="width: 30em; color:white; background-color: #2a9d8f; padding-right: 2em; padding-left: 2em; padding-top:1em; padding-bottom:1em; border-radius: 10px; text-align: justify; margin: 1em;">
            <img src="{{ url(Storage::url('img/logo.png')) }}" alt="logo" style="width: 100%;">
            <p><b>Hola {{ $usuario->name }} ,</b></p>
            <p>Para poder activar tu cuenta, debes confirmar esta dirección de correo, introduce el código que aparece a
                continuación para verificar tu cuenta.</p>

            <div style="display: flex; justify-content: center; font-size: 3em; text-align: center;">
                <strong style="letter-spacing: .2em; text-align: center; width:100%"> {{ $codigo }} </strong>
            </div>

            <p>Gracias por confiar en Gestrón</p>

            <p style="margin-top: 1em; text-align:center">Copyright - Gestrón 2022</p>
        </div>
    </div>
</body>

</html>
