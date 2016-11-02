
var mannageDom = function () {

	changeImg = function (imageUrl, opcion) {
		if (opcion === 'login') {
			$("#aImg").attr('src', imageUrl);
			//$("#divFormLogin").attr('display', 'none');
		}else if(opcion === 'logout'){
			$("#aImg").attr('src', imageUrl);
			$("#aImg").fadeIn();
			//$("#divFormLogin").attr('display', 'initial');
		}
			
	};

	return {
		changeImg: changeImg
	};

}();




