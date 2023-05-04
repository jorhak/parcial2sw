const cardElement = document.querySelector('#card')

const listUsers = async () => {
    try {
        const response = await fetch("http://localhost:5000/personas");
        const datos = await response.json();
        console.log(datos)
        let content = ``;
        datos.forEach((dato) => {
            content += `
            <div class="modal fade" id="staticBackdrop${dato.id}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content text-bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">${dato.detalle.origen} - ${dato.detalle.destino} (${dato.detalle.turno})</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Origen: ${dato.detalle.origen}</p>
                                <span>Destino: ${dato.detalle.destino}</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Aceptar</button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col">
                <div class="card h-100 text-bg-dark mb-3">
                    <img src="${dato.imagen}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">${dato.titulo}</h5>
                            <p class="card-text">${dato.descripcion}</p>
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop${dato.id}">
                                Más información
                             </button>
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

listUsers()

const inputElement = document.querySelector("#input-voz")
const recognition = new webkitSpeechRecognition();

recognition.continuous = true;
recognition.lang = 'es-ES';
recognition.interimResults = false;


window.onload = () => {
    recognition.start();
    console.log("Ready to receive a color command.");
}

recognition.onresult = (event) => {
    const texto = event.results[event.results.length - 1][0].transcript;
    console.log(texto)
    inputElement.value = texto;
}

function leerTexto(text){
    const speech = new SpeechSynthesisUtterance(text);
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;
    speech.lang = 'es-ES';

    window.speechSynthesis.speak(speech);
}

inputElement.addEventListener('change', leerTexto(inputElement.value))
