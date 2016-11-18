<?php 
	

	/**
	* Josué Erazo
	*/

	require_once "dao/ConDB.php";
	require_once "../code/vm/InstitucionesVm.php";

	class InstitucionesModel extends Conexion
	{
		
		private $_consulta;
        private $_query = "";
        private $_modelDb;

		function __construct()
		{
			$this->_modelDb = new Conexion();
			#parent::__construct();
		}

		public function GetInstituciones()
		{
			try {

				$this->_modelDb->Conectar();
				$this->_query = "Select * From instituciones where Codigos_IdCodigo = 1";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				#$this->_modelDb->Desconectar();
				return mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC);

			} catch (Exception $e) {

				echo $e;
			}finally{
                $this->_modelDb->Desconectar();
            }  
		}

		public function GetInstitucionById($id)
		{
			try {

				$this->_modelDb->Conectar();
				$this->_query = "Select IdInstitucion as Id, NombreInstitucion as Nombre, SiglaInstitucion as Siglas, DescripcionInstitucion as 
				                Descripcion, DireccionInstitucion as Direccion, FechaCreacion, PaginaWebInstitucion as PaginaWeb, TelefonoInstitucion as 
				                Telefono, Codigos_IdCodigo as Estado 
								From instituciones 
								Where IdInstitucion = '" . $id . "' and Codigos_IdCodigo = '1'";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);

				return mysqli_fetch_all($this->_consulta, MYSQLI_ASSOC);
			} catch (Exception $e) {
				echo $e;
			}finally{
                $this->_modelDb->Desconectar();
            }  
		}

		public function CrearInstitucion(InstitucionesVm $institucion)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "Insert INTO instituciones (NombreInstitucion, SiglaInstitucion, DescripcionInstitucion, TelefonoInstitucion,
								PaginaWebInstitucion, DireccionInstitucion, FechaCreacion, Codigos_IdCodigo) 
								VALUES ('".$institucion->Nombre."','". $institucion->Siglas ."','". $institucion->Descripcion."','". $institucion->Telefono
								."','". $institucion->PaginaWeb ."','". $institucion->Direccion ."','". $institucion->FechaCreacion ."','". $institucion->Estado."')";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				
				return $this->_consulta;

			} catch (Exception $e) {
				echo $e;
			}finally{
            	$this->_modelDb->Desconectar();
         	}  			
		}

		public function EditarInstitucion(InstitucionesVm $institucion)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "Update instituciones set NombreInstitucion = '".$institucion->Nombre."' ,SiglaInstitucion = '". $institucion->Siglas ."' ,DescripcionInstitucion = '". $institucion->Descripcion."' ,TelefonoInstitucion =  '". $institucion->Telefono ."', PaginaWebInstitucion = '". $institucion->PaginaWeb ."' ,DireccionInstitucion = '". $institucion->Direccion ."' ,FechaModificacion = '". $institucion->FechaModificacion ."' ,Codigos_IdCodigo = '". $institucion->Estado."' where IdInstitucion = ". $institucion->IdInstitucion." and Codigos_IdCodigo = 1" ;
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				return $this->_consulta;
			} catch (Exception $e) {
				return $e;
			}finally{
            	$this->_modelDb->Desconectar();
         	}  
		}

		public function EliminarInstitucion($id)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "update instituciones set Codigos_IdCodigo = 2 where IdInstitucion = " . $id;
				$this->_consulta = $this->_modelDb->_db->query($this->_query); 
				
				return $this->_consulta;					
				
			} catch (Exception $e) {
				return $e;
			}finally{
            	$this->_modelDb->Desconectar();
         	}  
		}
	}

	#$ins = new InstitucionesModel();

	#$ins->GetInstitucionById(1);
	
 ?>