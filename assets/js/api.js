const cardElement = document.querySelector("#card");

const listUsers = async () => {
  try {
    const response = await fetch("https://api-turismo.dev-soft.es/paquetes");
    const datos = await response.json();
    // console.log(datos);
    let content = `<div class="row row-cols-3 row-cols-md-3 g-4" > `;
    datos.forEach((dato) => {
      if (dato.id / 3 == 0) {
        content += `<div class="row row-cols-3 row-cols-md-3 g-4" >`;
      }
      content += `
            <div class="col">
                <div class="card h-100 text-bg-dark mb-3">
                    <img src="${dato.imagen1}" class="card-img-top fotos" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">${dato.nombre}</h3>
                            <p class="card-text "> Bs ${dato.costo}</p>
                            <p class="card-text"> Salida desde <strong>${dato.origen}</strong> </p>
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop${dato.id}">
                                Más información
                             </button>
                        </div>
                </div>
            </div>

            <div class="modal fade modal-xl" id="staticBackdrop${dato.id}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content text-bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><strong>${dato.nombre}</strong></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row" >
                                  <div class="col">
                                    <img src="${dato.imagen1}" class="card-img-top fotos">
                                  </div>
                                  <div class="col">
                                    <img src="${dato.imagen2}" class="card-img-top fotos" >
                                  </div>
                                  <div class="col">
                                    <img src="${dato.imagen3}" class="card-img-top fotos">
                                  </div>
                                <div class="row row-cols-2">
                                  <div class="col">
                                    <p>${dato.descripcion}</p>
                                    <p><strong>Salida desde: </strong>${dato.origen}</p>
                                    <p><strong>Destino: </strong>${dato.destino}</p>
                                    <p><strong>Costo: </strong>${dato.costo} bs.</p>
                                    <p><strong>Duracion: </strong>${dato.duracion} </p>
                                    <p><strong>Fecha de Salida: </strong>${dato.fecha_salida} </p>
                                  </div>
                                  <div class="col">
                                    <canvas id="MiGrafica${dato.id}" width="100px" height="100px"></canvas>
                                  </div>
                                </div>
                                <hr>
                                <h1><strong>Comentarios: </strong></h1>
                                <br><br><br>
                                <div class="row">
                                    <p>Pier Luigi Snow Targarien</p>
                                    <h5> A mi no me gusto el final de GOT </h5>
                                </div>
                                <hr>
                                <div class="row">
                                  <h3>Nuevos comentarios</h3><br>
                                  <button type="button" class="btn btn-primary">Publicar</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                          </div>
                        </div>
                    </div>
            </div>
            `;
    });

    cardElement.innerHTML = content;
    // --------------------------
    for (let i = 1; i <= 6; i++) {
      const responseResenas = await fetch(
        `https://api-turismo.dev-soft.es/resenas/${i}`
      );
      const datosResenas = await responseResenas.json();
      cantPositivos = 0;
      cantNegativos = 0;
      cantMixtos = 0;

      datosResenas.forEach((datoR) => {
        if (datoR.porcentaje > 0) {
          cantPositivos++;
        }
        if (datoR.porcentaje < 0) {
          cantNegativos++;
        }
        if (datoR.porcentaje == 0) {
          cantMixtos++;
        }
      });

      const miCanva = document.getElementById("MiGrafica" + i).getContext("2d");
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
    }

    // pier

    // --------------------------
  } catch (ex) {
    alert(ex);
  }
};

listUsers();

const inputVozElement = document.querySelector("#input-voz");
const recognition = new webkitSpeechRecognition();

recognition.continuous = true;
recognition.lang = "es-ES";
recognition.interimResults = false;

window.onload = () => {
  recognition.start();
  console.log("Ready to receive a color command.");
};

recognition.onresult = (event) => {
  const texto = event.results[event.results.length - 1][0].transcript;
  console.log(texto);
  inputVozElement.value = texto;
};

function leerTexto(text) {
  const speech = new SpeechSynthesisUtterance(text);
  speech.volume = 1;
  speech.rate = 1;
  speech.pitch = 1;
  speech.lang = "es-ES";

  window.speechSynthesis.speak(speech);
}

inputVozElement.addEventListener("change", leerTexto(inputVozElement.value));
