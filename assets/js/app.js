const API_KEY = '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'
const submitButton = document.querySelector('#submit')
const outPutElement = document.querySelector('#output')
const inputElement = document.querySelector('input')
const historyElement = document.querySelector('.history')
const buttonElement = document.querySelector('.new-chat')

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
        const response = await fetch('https://api.openai.com/v1/chat/completions', options)
        const data = await response.json()
        console.log(data)
        outPutElement.textContent = data.choices[0].message.content
        if (data.choices[0].message.content && inputElement.value){
            const pElement = document.createElement('p')
            pElement.textContent = inputElement.value
            pElement.addEventListener('click', () => changeInput(pElement.textContent))
            historyElement.append(pElement)
        }
        leerTexto()

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

