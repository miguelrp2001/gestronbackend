<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de registro</title>
</head>


<body
    style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
    <div
        style="display: flex; justify-content: center; font-family: Arial; flex-direction: column; align-items:center; gap: 1em; margin: 1em;">
        <div
            style="width: 30em; color:white; background-color: #2a9d8f; padding-right: 2em; padding-left: 2em; padding-top:1em; padding-bottom:1em; border-radius: 10px; text-align: justify; margin: 1em;">
            <img src="{{ url(Storage::url('img/logo.png')) }}" alt="logo" style="width: 100%;">
            <p><b>Hola {{ $admin->name }} ,</b></p>
            <p>Se ha dado de alta un nuevo usuario en Gestrón:</p>
            <dl>
                <dt style="font-weight: bold">Nombre:</dt>
                <dd>{{ $usuario->name }}</dd>
                <dt style="font-weight: bold">Email:</dt>
                <dd>{{ $usuario->email }}</dd>
                <dt style="font-weight: bold">Teléfono:</dt>
                <dd>{{ $usuario->telefono }}</dd>
                <hr style="width: 100%; border: 1px solid">
                <dt style="font-weight: bold">Nombre empresa:</dt>
                <dd>{{ $centro->nombre }}</dd>
                <dt style="font-weight: bold">Nombre legal:</dt>
                <dd>{{ $centro->nombre_legal }}</dd>
                <dt style="font-weight: bold">NIF:</dt>
                <dd>{{ $centro->nif }}</dd>
            </dl>

            <p style="margin-top: 1em; text-align:center">Copyright - Gestrón 2022</p>
        </div>
    </div>
</body>

</html>
