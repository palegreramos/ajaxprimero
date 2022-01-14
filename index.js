function insertar() {
		
	const data = new FormData(document.querySelector('form'));
	fetch('insertar.php', {
		method: 'POST',
		body: data
	})
	.then(function(response) {
		if(response.ok) {
			console.log(response);
			return response.statusText;
		} else {
			throw "Error en la llamada Ajax";
		}
	})
	.then(function(texto) {
		console.log(texto);
	})
	.catch(function(err) {
		console.log(err);
	});
} 

function leer() {
	fetch('leer.php')
	.then(response => response.json())
	.then(data => dibuja(data));
}

function buscar() {
	const data = new FormData(document.querySelector('form'));
	fetch('buscar.php', {
		method: 'POST',
		body: data
	})
	.then(response => response.json())
	.then(data => dibuja(data));
}

function dibuja(datos) {
	console.log(datos);
	//alert(JSON.stringify(datos));
	let misdatos="<ul>";
	for (let i in datos) {
		misdatos+=`<li>${datos[i].nombre} ${datos[i].apellidos}</li>`;
	}
	misdatos+="</ul>";
	document.querySelector("#dibuja").innerHTML=misdatos;
}


window.addEventListener("load",()=> {
	document.querySelector("#enviar").addEventListener("click",insertar);
	document.querySelector("#leer").addEventListener("click",leer);
	document.querySelector("#apellidos").addEventListener("input", buscar);
});