const btnComenzar = document.getElementById('comenzar');
const btnDetener = document.getElementById('detener');
const btnReproducir = document.getElementById('reproducir')
const textArea = document.getElementById('textArea');

const recognition = new webkitSpeechRecognition();

recognition.continuous = true;
recognition.lang = 'es-ES';
recognition.interimResults = false;

btnComenzar.addEventListener('click',()=>{
    recognition.start();
});

btnDetener.addEventListener('click',()=>{
    recognition.abort();
});

recognition.onresult = (event) => {
    const texto = event.results[event.results.length -1 ][0].transcript;
    console.log(texto)
    textArea.value = texto;
    leerTexto()
}



function leerTexto(){
    const speech = new SpeechSynthesisUtterance(textArea.value);
    speech.volume = 1;
    speech.rate = 0.8;
    speech.pitch = 0.4;
    speech.lang = 'es-ES';

    window.speechSynthesis.speak(speech);
}

btnReproducir.addEventListener('click', ()=>{
    leerTexto()
});


