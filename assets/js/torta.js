import { listUsers } from "./api.js";

document.addEventListener("DOMContentLoaded", () => {
  // Esperar a que se carguen los datos
  listUsers().then(async () => {
    const response = await fetch("http://localhost:8000/paquetes");
    const datos = await response.json();
    datos.forEach(async (dato) => {
      const cardBoton = document.getElementById("card" + dato.id);
      const boxComments = document.getElementById("boxComments" + dato.id);

      cardBoton.addEventListener("click", async () => {
        console.log("hola:::" + dato.id);
        await sendComment(dato.id)
        
        let content = ``;
        let commets = ``;
        const responseResenas = await fetch(
          `http://localhost:8000/resenas/${dato.id}`
        );
        const datosResenas = await responseResenas.json();
        let cantPositivos = 0;
        let cantNegativos = 0;
        let cantMixtos = 0;

        datosResenas.forEach((datoR) => {
          commets += `
            <h3>${datoR.nombre_cliente}</h3>
            <br>
            <p>${datoR.frase}</p><hr>`;
          if (datoR.porcentaje > 0) {
            cantPositivos++;
          }
          if (datoR.porcentaje < 0) {
            cantNegativos++;
          }
          if (datoR.porcentaje == 0) {
            cantMixtos++;
          }
          boxComments.innerHTML = commets;
        });

        const torta = document.getElementById("grafico" + dato.id);
        content += `
                    <canvas id="MiGrafica${dato.id}" width="100px" height="100px"></canvas>
                `;
        torta.innerHTML = content;
        const miCanva = document
          .getElementById("MiGrafica" + dato.id)
          .getContext("2d");
        new Chart(miCanva, {
          type: "pie",
          data: {
            labels: ["Buena Experiencia", "Mala Experiencia", "Mixta"],
            datasets: [
              {
                label: "Porcentaje de Aceptacion",
                data: [cantPositivos, cantNegativos, cantMixtos],
                backgroundColor: ["green", "red", "yellow"],
                hoverOffset: 4,
              },
            ],
          },
          options: {
            plugins: {
              legend: {
                position: "top",
                display: true,
              },
              title: {
                display: true,
                text: "ACEPTACION DEL PAQUETE",
              },
            },
          },
        });
      });
    });
  });
});

async function sendComment(idPaquete){
  const formularioComentario = document.getElementById("formulario-comentario"+idPaquete)
  formularioComentario.addEventListener("submit", async (event) => {
    event.preventDefault();

    // Obtener los valores del formulario
    const paquete = document.getElementById("paquete"+idPaquete).value;
    const nombre = document.getElementById("nombre"+idPaquete).value;
    const comentario = document.getElementById("comentario"+idPaquete).value;

    console.log(`Paquete: ${paquete} Nombre: ${nombre} Comentario: ${comentario}`);

    // Enviar los valores por POST a la API
    await fetch("http://localhost:3000/api/review", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id_paquete: paquete,
        nombre_cliente: nombre,
        frase: comentario,
      }),
    })
      .then((response) => response.json())
      .then((data) => console.log(data))
      .catch((error) => console.error(error));
  });
}

function clearFormulario(idPaquete){
    document.getElementById("nombre"+idPaquete).value = ""
    document.getElementById("comentario"+idPaquete).value = ""
}
