<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Enviar Express</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
       
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="index.html" class="logo"><img src="assets/images/logo.png" height="60" alt="logo"></a>
                                                </div>
    
                                        
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form class="" action="index.html">
                    
                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username">Usuarios22</label>
                                                        <input type="text" class="form-control" id="usuario" placeholder="Ingresa tu usuario">
                                                    </div>
                            
                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Contraseña</label>
                                                        <input type="password" class="form-control" id="contrasena" placeholder="Ingresa tu contrasena">
                                                    </div>
                            
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customControlInline">
                                                        <label class="form-check-label" for="customControlInline">Recordar</label>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" onclick="login()" type="button">Ingresar</button>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <a href="recuperar_contrasena.php" class="text-muted"><i class="mdi mdi-lock me-1"></i>Olvidastes tu contraseña?</a>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                               
                                                <p>© <script>document.write(new Date().getFullYear())</script> Enviar Express</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

        <script src="assets/js/functions/index/index.js"></script>


    </body>
</html>
