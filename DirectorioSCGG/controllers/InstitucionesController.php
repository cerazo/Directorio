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
		public function CrearInstitucion($institucion)
		{
			date_default_timezone_set("America/Tegucigalpa");
			$this->_institucionesVm->Nombre = $institucion->data->Nombre;
			$this->_institucionesVm->Siglas = $institucion->data->Siglas;
			$this->_institucionesVm->Direccion = $institucion->data->Direccion;
			$this->_institucionesVm->Telefono = $institucion->data->Telefono;
			$this->_institucionesVm->Estado = 1;
			$this->_institucionesVm->PaginaWeb = $institucion->data->PaginaWeb;
			$this->_institucionesVm->Descripcion = $institucion->data->Descripcion;
			$this->_institucionesVm->FechaCreacion = date("Y-m-d h:m:s a");
			//$this->_institucionesVm->Codigo = $institucion->Codigo;

			$inst = $this->_institucionesModel->CrearInstitucion($this->_institucionesVm);
			return $inst;
		}

		public function EditarInstitucion($data)
		{
			date_default_timezone_set("America/Tegucigalpa");
			$this->_institucionesVm->IdInstitucion = $data->data->IdInstitucion;
			$this->_institucionesVm->Nombre = $data->data->Nombre;
			$this->_institucionesVm->Siglas = $data->data->Siglas;
			$this->_institucionesVm->Direccion = $data->data->Direccion;
			$this->_institucionesVm->Telefono = $data->data->Telefono;
			$this->_institucionesVm->Estado = $data->data->Estado;
			$this->_institucionesVm->PaginaWeb = $data->data->PaginaWeb;
			$this->_institucionesVm->Descripcion = $data->data->Descripcion;
			$this->_institucionesVm->FechaModificacion = date("Y-m-d h:m:s a");
			//$this->_institucionesVm->Codigo = $data->Estado;
			
			$inst = $this->_institucionesModel->EditarInstitucion($this->_institucionesVm);
			return $inst;
		}

		public function EliminarInstitucion($id)
		{
			$resp = $this->_institucionesModel->EliminarInstitucion($id);
			return $resp;
		}
	}

	#$i = new InstitucionesController();

	#$i->GetInstitucionById(1);


 ?>