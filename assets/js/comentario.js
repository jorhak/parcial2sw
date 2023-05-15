import  { listUsers } from './api.js'





async function main(){
const modal = await listUsers()

   const sendElemento = document.getElementById('sendMessage') 
   async function sendMessage(){
      const paquete = document.getElementById('paquete')
      const nombre = document.getElementById('nombre')
      const comentario = document.getElementById('comentario')

      const options={
         method: "POST",
         headers: {"Content-Type": "application/json"},
         body: JSON.stringify({
	   messages:[{paquete: paquete.value, nombre:nombre.value , comentario:comentario.value}]
         }),
      }
      try{
         //await fetch('localhost/apiComentario',options)
         console.log("Paquete:"+paquete.value +"Nombre: "+ nombre.value +"Comentario: "+ comentario.value)
         console.log("hola")
      } catch (error) {
         console.error(error)
      }
   }

   sendElemento.addEventListener('click',sendMessage)
}


