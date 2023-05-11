const API_KEY = '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'
const submitButton = document.querySelector('#submit')
const outPutElement = document.querySelector('#output')
const inputElement = document.querySelector('input')
const historyElement = document.querySelector('.history')
const buttonElement = document.querySelector('.new-chat')

let idCliente = null
let idPaquete = null

function changeInput(value){
    const inputElement = document.querySelector('input')
    inputElement.value = value
}

async function getMessage(){
    console.log('clicked')
    const options = {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${API_KEY}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{role: "user", content: inputElement.value}],
            max_tokens: 100
        })
    }
    try
    {
        /*http://localhost:3000/api/mensaje?text=mensa a mandar &idCliente=null &idPaquete=null*/
        const response = await fetch(`http://localhost:3000/api/mensaje?text=${inputElement.value}&idCliente=${idCliente}&idPaquete=${idPaquete}`)
        const data = await response.json()
        if (data.intentName=='solicitar_servicio'){
            const paquetes = data.paquetes
            let content = ``
            paquetes.forEach(paquete => {
                content += `
                    ID: ${paquete.id}, Paquete: ${paquete.nombre} </br>
                `
                content += `Elija un ID por favor:`
            });
            outPutElement.textContent = content
            leerTexto()
        }

        if (data.intentName=='Elegir_paquete'){
            outPutElement.textContent = data.response
            idCliente = data.idCliente
            idPaquete = data.parameters.nro_paquete.numberValue
            leerTexto()
        }

        if (data.intentName=='pedir_nombre'){
            outPutElement.textContent = data.response
            idCliente = data.idCliente
            idPaquete = data.idPaquete
            leerTexto()
        }

        if (data.intentName=='pedir_ci'){
            outPutElement.textContent = data.response
            idCliente = data.idCliente
            idPaquete = data.idPaquete
            leerTexto()
        }

        if (data.intentName=='pedir_correo'){
            outPutElement.textContent = data.response
            idCliente = data.idCliente
            idPaquete = data.idPaquete
            leerTexto()
        }

        if (data.response && inputElement.value){
            const pElement = document.createElement('p')
            pElement.textContent = inputElement.value
            pElement.addEventListener('click', () => changeInput(pElement.textContent))
            historyElement.append(pElement)
        }

        /* outPutElement.textContent = data.choices[0].message.content
        if (data.choices[0].message.content && inputElement.value){
            const pElement = document.createElement('p')
            pElement.textContent = inputElement.value
            pElement.addEventListener('click', () => changeInput(pElement.textContent))
            historyElement.append(pElement)
        }
        leerTexto() */

        console.log(data)
    } catch (error) {
        console.error(error)
    }
}

submitButton.addEventListener('click',getMessage)

function clear(){
    inputElement.value = ''
}

buttonElement.addEventListener('click',clear)

function leerTexto(){
    const speech = new SpeechSynthesisUtterance(outPutElement.textContent);
    speech.volume = 1;
    speech.rate = 0.8;
    speech.pitch = 0.4;
    speech.lang = 'es-ES';

    window.speechSynthesis.speak(speech);
}

