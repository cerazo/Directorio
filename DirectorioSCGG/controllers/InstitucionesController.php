<?php 
	

	/**
	* Josué Lobo
	*/

	require_once "../code/dto/InstitucionesDto.php";
	require_once "../code/vm/InstitucionesVm.php";
	require_once "../model/InstitucionesModel.php";

	class InstitucionesController
	{
		
		private $_institucionesDto;
		private $_institucionesVm;
		private $_institucionesModel;

		function __construct()
		{
			$this->_institucionesVm = new InstitucionesVm();
			$this->_institucionesModel = new InstitucionesModel();
			

		}

		public function GetInstituciones()
		{
			$u = array();
			$i = 0;
			$instituciones = $this->_institucionesModel->GetInstituciones();
			if (!empty($instituciones)) {
				foreach ($instituciones as $inst) 
				{
					$this->_institucionesDto = new InstitucionesDto();
					$i = $i+1;
					$this->_institucionesDto->Id = $inst["IdInstitucion"];
					$this->_institucionesDto->Nombre = $inst["NombreInstitucion"];
					$this->_institucionesDto->Siglas = $inst["SiglaInstitucion"];
					$this->_institucionesDto->PaginaWeb = $inst["PaginaWebInstitucion"];
					$this->_institucionesDto->Direccion = $inst["DireccionInstitucion"];
					$this->_institucionesDto->Telefono = $inst["TelefonoInstitucion"];
					$u[$i] = $this->_institucionesDto; 
				}

				return json_encode($u);
				#echo $this->_institucionesDto->Nombre;
			}else{
				return $this->_institucionesDto;
			}
		}

		public function GetInstitucionById($id)
		{
			$institucion = $this->_institucionesModel->GetInstitucionById($id);
			if (!empty($institucion)) {
				foreach ($institucion as $value) {
					$this->_institucionesVm->IdInstitucion = $value["Id"];
					$this->_institucionesVm->Nombre = $value["Nombre"];
					$this->_institucionesVm->Siglas = $value["Siglas"];
					$this->_institucionesVm->Direccion = $value["Direccion"];
					$this->_institucionesVm->Telefono = $value["Telefono"];
					$this->_institucionesVm->Estado = $value["Estado"];
					$this->_institucionesVm->PaginaWeb = $value["PaginaWeb"];
					$this->_institucionesVm->Descripcion = $value["Descripcion"];
					$this->_institucionesVm->FechaCreacion = $value["FechaCreacion"];
				}
				
				return json_encode($this->_institucionesVm);
			}else{
				return $this->_institucionesVm;
			}
		}

		public function EliminarInstitucion($id)
		{
			return $this->_institucionesModel->EliminarInstitucion($id);
		}

		public function EditarInstitucion($data)
		{
			$this->_institucionesVm->Nombre = $data->Nombre;
			$this->_institucionesVm->Siglas = $data->Siglas;
			$this->_institucionesVm->Direccion = $data->Direccion;
			$this->_institucionesVm->Telefono = $data->Telefono;
			$this->_institucionesVm->Estado = $data->Estado;
			$this->_institucionesVm->PaginaWeb = $data->PaginaWeb;
			$this->_institucionesVm->Descripcion = $data->Descripcion;
			$this->_institucionesVm->FechaCreacion = $data->FechaCreacion;
			$this->_institucionesVm->Codigo = $data->Codigo;
			$this->_institucionesModel->EditarInstitucion();
		}

		public function CrearInstitucion($institucion)
		{
			$this->_institucionesVm->Nombre = $institucion->Nombre;
			$this->_institucionesVm->Siglas = $institucion->Siglas;
			$this->_institucionesVm->Direccion = $institucion->Direccion;
			$this->_institucionesVm->Telefono = $institucion->Telefono;
			$this->_institucionesVm->Estado = $institucion->Estado;
			$this->_institucionesVm->PaginaWeb = $institucion->PaginaWeb;
			$this->_institucionesVm->Descripcion = $institucion->Descripcion;
			$this->_institucionesVm->FechaCreacion = $institucion->FechaCreacion;
			$this->_institucionesVm->Codigo = $institucion->Codigo;

			$inst = $this->_institucionesModel->CrearInstitucion($this->_institucionesVm);
		}
	}

	#$i = new InstitucionesController();

	#$i->GetInstitucionById(1);


 ?>