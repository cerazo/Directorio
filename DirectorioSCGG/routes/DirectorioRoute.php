<?php
    

    include "../controllers/UsuariosController.php";
    include "../controllers/InstitucionesController.php";

    $usuarioController = new UsuariosController();
    $institucionesController = new InstitucionesController();


    #$data = $_POST['data'];
    $opcion = $_GET['opcion'];
        if(!empty($opcion)){
            $data = json_decode(file_get_contents("php://input"));
            switch ($opcion) {
                case "login":
                    if (!empty($data)) {

                        #$correo = $data->correo;
                        #$pass = $data->password;
                        $userData = $usuarioController->GetUsuario($data->correo, $data->password);
                        if ($userData) {
                            echo $userData;
                        }else {
                            echo "";
                        }
                    }
                    break;
                case 'getUbyId':
                    if(!empty($data)){
                        $usuarioController->GetUsuarioById($data);
                    }
                    break;
                case 'getUbyIns':
                    
                    break;
                case 'getUserByEmail':
                    $userData = $usuarioController->RestablecerContraseña($data->correo);
                    echo $userData;
                    break; 
                case 'listarInstituciones':
                       $instituciones = $institucionesController->GetInstituciones();
                       echo $instituciones;
                       break;
               case 'getInstId':
                      if(!empty($data)){
                          $institucion = $institucionesController->GetInstitucionById($data->id);
                          echo $institucion;
                      }
                      break;
                case 'crearInst':
                    if (!empty($data)) {
                        $institucion = $institucionesController->CrearInstitucion($data);
                        echo $institucion;
                    }
                    break;                      
                case 'editInstId':
                      if (!empty($data)) {
                          $institucion = $institucionesController->EditarInstitucion($data);   
                          echo $institucion;                 
                      }
                  break;
                case 'deleteInst':
                       if (!empty($data)) {
                           $institucion = $institucionesController->EliminarInstitucion($data->id);
                       }
                       break;
                case 'resetPass':
                     $usuario = $usuarioController->RestablecerContraseña($data);
                     break;   
                default:
                    // code...
                    break;
            }
        }
?>