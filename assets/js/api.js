const cardElement = document.querySelector("#card");

export const listUsers = async () => {
  try {
    const response = await fetch("http://localhost:8000/paquetes");
    const datos = await response.json();
    // console.log(datos);
    let content = `<div class="row row-cols-3 row-cols-md-3 g-4" > `;
    datos.forEach(async (dato) => {
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
                                data-bs-target="#modelo${dato.id}" id="card${dato.id}">
                                Más información
                             </button>
                        </div>
                </div>
            </div>

            <div class="modal fade modal-xl" id="modelo${dato.id}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                  <div class="col" id="grafico${dato.id}">
                                  </div>
                                </div>
                                <hr>
                                <h1><strong>Comentarios: </strong></h1>
                                <br><br><br>
                                <div class="row" id="boxComments${dato.id}">
                                </div>
                                <hr>
                                <div class="row">
                                  <form id="formulario-comentario${dato.id}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="paquete${dato.id}" value="${dato.id}" style="display:none">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre${dato.id}">
                                    </div>
                                    <div class="form-group">
                                        <label for="comentario">Comentario:</label>
                                        <textarea class="form-control" rows="5" id="comentario${dato.id}"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="sendM${dato.id}">Enviar</button>
                                  </form>
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
  } catch (ex) {
    alert(ex);
  }
};

// listUsers();

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
