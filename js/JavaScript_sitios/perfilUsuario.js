window.onload = function()
{
	var botonModificar = window.document.querySelectorAll('.botonModificar');

	var infoMostrar = window.document.querySelectorAll('.infoMostrar');
	var infoModificar = window.document.querySelectorAll('.infoModificar');


	function nombre ()
	{

	}

	for (var i = 0; i < botonModificar.length; i++)
	{
		botonModificar[i].addEventListener('click', function()
		{
			this.parentNode.style.display='none';
			this.parentNode.parentNode.children[2].style.display='block';
		});	
	}

	



}