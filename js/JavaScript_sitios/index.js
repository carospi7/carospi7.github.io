window.onload = function()
{
	var botonConectar = window.document.getElementById('botonConectar');
	var navegacionContarse = window.document.getElementById('navegacionContarse');
	var botonSeccionConectarse = window.document.getElementById('botonSeccionConectarse');
	var botonSeccionRegistrarse = window.document.getElementById('botonSeccionRegistrarse');
	var seccionConectarse = window.document.getElementById('conectarse');
	var seccionRegistrarse = window.document.getElementById('registrarse');
	var seccionBlackLayer = document.getElementById('blackLayer');

	botonConectar.addEventListener('click', function()
	{
		navegacionContarse.style.display='initial';
		seccionConectarse.style.display='initial';
		seccionBlackLayer.style.display='initial';

		document.addEventListener( 'keydown', function(e) {
		if( e.which === 27 ) {	
			seccionConectarse.style.display='none'; 
			navegacionContarse.style.display='none';
			seccionBlackLayer.style.display='none';
			} 
		});
	});

	botonSeccionConectarse.addEventListener('click', function()
	{
		seccionConectarse.style.display='initial';
		seccionRegistrarse.style.display='none';
		seccionBlackLayer.style.display='initial';
		
		document.addEventListener( 'keydown', function(e) {
		if( e.which === 27 ) {	
			seccionConectarse.style.display='none';
			navegacionContarse.style.display='none';
			seccionBlackLayer.style.display='none'; 
			} 
		});
	});

	botonSeccionRegistrarse.addEventListener('click', function()
	{
		seccionConectarse.style.display='none';
		seccionRegistrarse.style.display='initial';
		seccionBlackLayer.style.display='initial';
		
		document.addEventListener( 'keydown', function(e) {
		if( e.which === 27 ) {	
			seccionRegistrarse.style.display='none';
			navegacionContarse.style.display='none'; 
			seccionBlackLayer.style.display='none';
			} 
		});
	});

	seccionBlackLayer.addEventListener( 'click', function() {
		seccionConectarse.style.display='none';
		seccionRegistrarse.style.display='none';
		navegacionContarse.style.display='none'; 
		seccionBlackLayer.style.display='none';
	});


}