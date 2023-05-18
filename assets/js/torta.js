import { listUsers } from "./api.js";

document.addEventListener("DOMContentLoaded", () => {
  // Esperar a que se carguen los datos
  listUsers().then(async () => {
    const response = await fetch("http://localhost/reportePdf/paquetes");
    const datos = await response.json();
    datos.forEach(async (dato) => {
      const cardBoton = document.getElementById("card" + dato.id);
      const boxComments = document.getElementById("boxComments" + dato.id);

      cardBoton.addEventListener("click", async () => {
        console.log("hola" + dato.id);

        let content = ``;
        let commets = ``;
        const responseResenas = await fetch(
          `http://localhost/reportePdf/resenas/${dato.id}`
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
