import { listUsers } from './api.js';

document.addEventListener('DOMContentLoaded', () => {


  // Esperar a que se carguen los datos
  listUsers().then(() => {
    
    

    // Capturar el formulario de comentarios
    const formularioComentario = document.getElementById('formulario-comentario');
    // Agregar un evento para el envío del formulario
    formularioComentario.addEventListener('submit', async event => {
      event.preventDefault();

      // Obtener los valores del formulario
      const paquete = document.getElementById('paquete').value
      const nombre = document.getElementById('nombre').value;
      const comentario = document.getElementById('comentario').value;

      console.log(`Nombre: ${nombre} Comentario: ${comentario}`)

      // Enviar los valores por POST a la API
      await fetch('http://localhost:3000/api/review', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          "id_paquete": paquete,
          "nombre_cliente": nombre,
          "frase": comentario
        })
      })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
    });
  });



});


