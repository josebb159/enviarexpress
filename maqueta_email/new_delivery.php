<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso en Enviar Express</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
        .btn:hover {
            background: #0056b3;
        }
        .footer {
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
        .alert {
            color: #d9534f;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Bienvenido a Enviar Express!</h1>
        <p>Tu cuenta ha sido validada exitosamente como delivery en Enviar Express.</p>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($datos['usuario']) ?></p>
        <p><strong>Correo Electrónico:</strong> <?= htmlspecialchars($datos['email']) ?></p>
        <p><strong>Contraseña :</strong> <span class="alert"><?= htmlspecialchars($datos['password']) ?></span></p>
  
        <p class="footer">
            No compartas tu contraseña con nadie. Si no reconoces este registro, por favor contáctanos de inmediato.
        </p>
    </div>
</body>
</html>
