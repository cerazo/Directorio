

function appFactories () {
	var app = this;
	app.logeado = false;
	app.correo = '';
	app.UserObejct = new Object();
	app.Instituciones = new Object();

	app.SetUserObject = function (obj) {
		return app.UserObejct = obj;
	};

	app.SetInstitucionesObject = function(obj){
		return app.Instituciones = obj;
	}

}


scggApp.factory('scggFactory', [function () {
	return new appFactories();		
}])