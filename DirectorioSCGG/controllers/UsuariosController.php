

<?php  
/**
	* created by Carlos Josué Lobo
*/
	//require_once '../code/vm/EmpleadoVm.php';
	require_once "../code/dto/UsuarioDto.php";
	require_once "../model/UsuariosModel.php";
	require_once "../code/vm/UsuarioVm.php";
	//require 'code/vm/EmpleadoVm';
	/**
	* 
	*/
	class UsuariosController 
	{
		
		private $_usuariosModel;
		private $_usuarioVm;
		private $_usuarioDto;
		private $query = "";
		
		function __construct()
		{
			$this->_usuarioModel =  new UsuariosModel();
			$this->_usuarioVm = new UsuarioVm();
			$this->_usuarioDto = new UsuarioDto();
		}
		
		public function GetUsuario($userEmail, $userPass)
		{
			//$this->query = "Select * From Usuarios Where Codigos_IdCodigos = 1";
			
			$usuario = $this->_usuarioModel->GetUsuarioLog($userEmail, $userPass);
			if (!empty($usuario)) {
				foreach ($usuario as $user) {
                    $this->_usuarioVm->IdUsuario = $user['IdUsuario'];
                    $this->_usuarioVm->NombreUsuario = $user['NombreUsuario'];
                    $this->_usuarioVm->ApellidoUsuario = $user['ApellidoUsuario'];
                    $this->_usuarioVm->Contrasena = $user['Contrasena'];
                    $this->_usuarioVm->TelefonoUsuario = $user['TelefonoUsuario'];
                    $this->_usuarioVm->CorreoUsuario = $user['CorreoUsuario'];
                    $this->_usuarioVm->FechaCreacionUsuario = $user['FechaCreacionUsuario'];
                    $this->_usuarioVm->FechaModificacionUsuario = $user['FechaModificacionUsuario'];
                    $this->_usuarioVm->IdRol = $user['Roles_IdRol'];
                    $this->_usuarioVm->IdCodigo = $user['Codigos_IdCodigo'];
                    $this->_usuarioVm->IdInstitucion = $user['Instituciones_IdInstitucion'];
                }
                return json_encode($this->_usuarioVm);
				 
			}else{
				echo 'Vacio';
			}			
		}
		
		public function GetUsuarioById($id)
		{
			$usuario = $this->_usuarioModel->GetUsuarioById($Id);
			
			foreach ($usuario as $u) {	
				$this->_usuarioDto->Nombre = $u['Nombre'];
				$this->_usuarioDto->Apellido = $u['Apellido'];
				$this->_usuarioDto->Correo = $u['Correo'];
				$this->_usuarioDto->Telefono = $u['Telefono'];
				$this->_usuarioDto->FechaCreacion = $u['FechaCreacion'];
				$this->_usuarioDto->Rol = $u['Rol'];
				$this->_usuarioDto->Institucion = $u['Institucion'];
			}

			return json_encode($this->_usuarioDto);
		}

		public function CrearUsuario()
		{
			
		}

		public function RestablecerContraseña($data)
		{
			$usuario = $this->_usuarioModel->RestablecerContraseña($data);
			if (!empty($usuario)) {
				echo json_encode($usuario);
			}else{
				echo json_encode($usuario);
			}
		}
	}
	
	#$uController = new UsuariosController();
	
	#$uController->GetUsuario("cerazo@scgg.gob.hn", "123456");
	

?>