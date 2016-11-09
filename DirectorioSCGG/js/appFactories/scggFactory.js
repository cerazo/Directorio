

function appFactories () {
	var app = this;
	app.logeado = false;
	app.rol;
	app.UserObejct = new Object();
	app.Instituciones = new Object();

	app.SetUserObject = function (obj) {
		app.UserObejct = obj;
		app.rol = app.UserObejct.IdRol;
	};

	app.SetInstitucionesObject = function(obj){
		app.Instituciones = obj;
	};

	app.GetInstituciones = function(){
		return app.Instituciones;
	}

}


scggApp.factory('scggFactory', [function () {
	return new appFactories();		
}])