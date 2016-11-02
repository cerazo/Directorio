<?php
    
 /**
    * created by Josué Lobo
*/   
    
    require_once "dao/ConDB.php";
    require_once "../code/vm/UsuarioVm.php";

    class UsuariosModel 
    {
        
        private $_modelDb;
        private $_consulta;
        private $_query = "";

        public function __construct()
        {
            $this->_modelDb = new Conexion();
        }
                

        public function GetUsuarioLog($userEmail, $userPass){

            try {
                $this->_modelDb->Conectar();
                $this->_query = "Select * From Usuarios Where CorreoUsuario = '" . $userEmail . "' and Contrasena = '" . $userPass ."' and Codigos_IdCodigo = 1";
                $consulta = $this->_modelDb->_db->query($this->_query);
                
                //print_r($usuario);
                return mysqli_fetch_all($consulta, MYSQLI_ASSOC);;

            } catch (Exception $e) {
                return "Ocurrio un error al solicitar la peticion " .  $e;
            }finally{
                $this->_modelDb->Desconectar();
            }          
        }
        
        public function GetUsuarios()
        {
            try {
                $this->_modelDb->Conectar();
                $this->_query = "Select u.IdUsuario, u.NombreUsuario as Nombre, u.ApellidoUsuario as Apellido, u.TelefonoUsuario as Telefono, 
                                u.CorreoUsuario as Correo, u.FechaCreacionUsuario as Fecha, r.DescripcionRol as Rol, i.NombreInstitucion as Institucion, 
                                c.DescripcionCodigo as Estado
                                FROM usuarios u
                                inner join instituciones i on u.Instituciones_IdInstitucion = i.IdInstitucion and i.Codigos_IdCodigo = 1
                                inner join roles r on u.Roles_IdRol = r.IdRol and r.Codigos_IdCodigo = 1
                                inner join codigos c on u.Codigos_IdCodigo = c.IdCodigo
                                where u.Codigos_IdCodigo = 1";

                $this->_consulta = $this->_modelDb->_db->query($this->_query);
                return mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC);
            } catch (Exception $e) {
                echo $e;
            }finally{
                $this->_modelDb->Desconectar();
            }  
        }

        public function GetUsuarioByInstitucion($idInstitucion)
        {
            try{
                $this->_consulta = "select * from usuarios where Instituciones_IdInstitucion = '" . $idInstitucion . "'";
                $this->_db->query($this->_consulta);
            }catch(Exception $e){
                return "Ocurrio un error al solicitar la peticion " . $e;
            }finally{
                $this->_modelDb->Desconectar();
            }  
        }
        
        public function GetUsuarioById($id)
        {
            try {
                $this->_query = "Select  from usuarios where IdUsuarios = '" . $id ."'";
                $this->_consulta = $this->_modelDB->_db->query($this->_query);
                #$this->_modelDb->Desconectar();
                return mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC);

            } catch (Exception $e) {
                return "Ocurrio un error al solicitar la peticion " .  $e; 
            }finally{
                $this->_modelDb->Desconectar();
            }  
            
        }

        public function CrearUsuario(UsuarioVm $usuario)
        {
            try {
                $this->_modelDb->Conectar();
                $this->_query = "Insert into usuarios (IdUsuario, NombreUsuario, ApellidoUsuario, Contrasena, TelefonoUsuario, 
                                CorreoUsuario, FechaCreacionUsuario, Roles_IdRol, Codigos_IdCodigo, Instituciones_IdInstitucion)
                                values('". $usuario->NombreUsuario ."','".$usuario->ApellidoUsuario."','".$usuario->Contrasena."','"
                                .$usuario->TelefonoUsuario."','"
                                .$usuario->CorreoUsuario."','".$usuario->FechaCreacionUsuario."','".$usuario->IdRol."','".$usuario->IdCodigo."','"
                                .$usuario->IdInstitucion."')";
                $this->_consulta = $this->_modelDb->_db->query($this->_query);
                #$this->_modelDb->Desconectar();
                return mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC);
            } catch (Exception $e) {
                return $e;
            }finally{
                $this->_modelDb->Desconectar();
            }  
            
        }

        public function RestablecerContrseña($data){
            try {
                $this->_modelDb->Conectar();
                $this->_query = "Select IdUsuario From usuarios where CorreoUsuario = '". $data->correo ."' and Codigos_IdCodigo = 1";
                $this->_consulta = $this->_modelDB->_db->query($this->_query);
                if ($this->_consulta) {
                    $resp = mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC); 
                    $this->_query = "Update usuarios set Contrasena = '" .$data->contraseña. "' where CorreoUsuario = '" .$data->correo. "' and IdUsuario = " .$resp['IdUsuario'];
                    $this->_consulta = $this->_modelDb->_db->query($this->_query);
                    return "Ok";
                }else {
                    return "El correo ingresado no existe. Verifique su informcaion.";
                }
                
            } catch (Exception $e) {
                return $e;
            }finally{
                $this->_modelDb->Desconectar();
            }             
        }
        
    }

/*$ins = new UsuariosModel();

$usuario = $ins -> GetUsuarioLog("cerazo@scgg.gob.hn", "123456");*/
    
