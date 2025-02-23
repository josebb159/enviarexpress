<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            font-size: 1.2rem;
            padding: 10px;
        }
        .form-label i {
            margin-right: 5px;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-motorcycle"></i> Postulación a Delivery <br> Enviar Express
            </div>
            <div class="card-body">
                <form id="deliveryForm" action="send_postulation.php" method="POST" enctype="multipart/form-data">
                    
                    <h5 class="text-center mb-3">Datos Personales</h5>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-id-card"></i> Cédula:</label>
                        <input type="text" name="cedula" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Correo:</label>
                        <input type="text" name="correo" class="form-control" required>
                    </div>
1

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Dirección:</label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Número de teléfono:</label>
                        <input type="text" name="numero" id="numero" class="form-control" required>
                        <span id="errorNumero" class="error">Formato inválido (000-0000-000)</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-exclamation-triangle"></i> Número de emergencia:</label>
                        <input type="text" name="numero_emergencia" id="numeroEmergencia" class="form-control" required>
                        <span id="errorEmergencia" class="error">Formato inválido (000-0000-000)</span>
                    </div>

                    <h5 class="text-center mt-4 mb-3">Documentos Requeridos</h5>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-id-badge"></i> Foto Cédula:</label>
                        <input type="file" name="foto_cedula" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-car"></i> Foto Licencia:</label>
                        <input type="file" name="foto_licencia" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-file-contract"></i> Foto SOAT:</label>
                        <input type="file" name="foto_soat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-certificate"></i> Foto Tecnomecánica:</label>
                        <input type="file" name="foto_tecnomecanica" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-credit-card"></i> Foto Tarjeta de Propiedad:</label>
                        <input type="file" name="foto_tarjeta" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-file-image"></i> Foto Facial:</label>
                        <input type="file" name="foto_facial" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-file-image"></i> Propiedad:</label>
                        <input type="file" name="propiedad" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-check-circle"></i> Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
      function formatPhoneInput(input) {
            input.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, ''); // Elimina caracteres no numéricos

                // Aplica el formato 000-0000-000
                if (value.length > 3) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                }
                if (value.length > 8) {
                    value = value.slice(0, 8) + '-' + value.slice(8);
                }

                e.target.value = value.slice(0, 12); // Limita el input al formato correcto
            });
        }

        // Aplica la función a ambos inputs
        formatPhoneInput(document.getElementById('telefonoagg'));
        formatPhoneInput(document.getElementById('numeroEmergencia'));

        document.getElementById("deliveryForm").addEventListener("submit", function(event) {
            let numero = document.getElementById("telefonoagg").value;
            let numeroEmergencia = document.getElementById("numeroEmergencia").value;
            let errorNumero = document.getElementById("errorNumero");
            let errorEmergencia = document.getElementById("errorEmergencia");
            let regex = /^\d{3}-\d{4}-\d{3}$/;

            let valid = true;

            if (!regex.test(numero)) {
                errorNumero.style.display = "block";
                valid = false;
            } else {
                errorNumero.style.display = "none";
            }

            if (!regex.test(numeroEmergencia)) {
                errorEmergencia.style.display = "block";
                valid = false;
            } else {
                errorEmergencia.style.display = "none";
            }

            if (!valid) {
                event.preventDefault(); // Evita el envío si hay errores
            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
