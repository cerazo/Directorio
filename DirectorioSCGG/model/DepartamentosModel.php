<?php 
	

	/**
	* 
	*/

	require_once "dao/ConDB.php";
	require 'code/vm/DepartamentoVm.php';

	class DepartamentosModel
	{
		
		private $_modelDb;
		private $_consulta;
		private $_query;

		function __construct(argument)
		{
			$this->_modelDb = new Conexion();
		}

		public function GetDepartamentos()
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "SELECT d.IdDepartamento as Id, d.NombreDepartamento as Nombre, d.TelefonoDepartamento as Telefono, d.DescripcionDepartamento as 	
								Descripcion, i.NombreInstitucion as Institucion
								FROM departamentos d
								INNER JOIN instituciones i on d.Instituciones_IdInstituciones = i.IdInstitucion and i.Codigos_IdCodigo = 0
								WHERE d.Codigos_IdCodigo = 0 ";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				return mysqli_fetch_all($this->_consulta);
			} catch (Exception $e) {
				echo "Ocurrio un error " . $e;			
			}finally{
				$this->_modelDb->Desconectar();
			}
		}
		
		public function GetDepartamentoById($id)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "SELECT d.IdDepartamento as Id, d.NombreDepartamento as Nombre, d.TelefonoDepartamento as Telefono, d.DescripcionDepartamento as Descripcion, 
								d.Codigos_IdCodigo as Estado
								FROM departamentos d
								INNER JOIN instituciones i on d.Instituciones_IdInstituciones = i.IdInstitucion and i.Codigos_IdCodigo = 1
								WHERE d.IdDepartamento = '$id' AND d.Codigos_IdCodigo = 1";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				return mysqli_fetch_all($this->_consulta);
			} catch (Exception $e) {
				echo "Algo salio mal " .$e;
			}finally{
				$this->_modelDb->Desconectar();
			}
		}

		public function CrearDepartamento(DepartamentoVm $departamento)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "INSERT INTO departamentos (IdDepartamento, NombreDepartamento, TelefonoDepartamento, DescripcionDepartamento, FechaCreacion, FechaModificacion, Instituciones_IdInstituciones, Codigos_IdCodigo) VALUES ('$departamento->IdDepartamento','$departamento->NombreDepartamento','$departamento->Telefono','$departamento->Descripcion','$departamento->FechaCreacion','$departamento->FechaModificacion','$departamento->IdInstitucion','$departamento->Estado')";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				return $this->_consulta;
			} catch (Exception $e) {
				return "Algo salio mal " . $e;
			}finally{
				$this->_modelDb->Desconectar();
			}
		}

		public function EditarDepartamento(DepartamentoVm $departamento)
		{
			try {
				$this->_modelDb->Conectar();
				$this->_query = "";
				$this->_consulta = $this->_modelDb->_db->query($this->_query);
				return $this->_consulta;
			} catch (Exception $e) {
				return "Algo salio mal " .$e;
			}finally{
				$this->_modelDb->Desconectar();
			}
		}

		public function EliminarDepartamento($id)		
		{
			
		}
	}

?>