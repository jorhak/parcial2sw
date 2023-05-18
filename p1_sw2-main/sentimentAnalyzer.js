const { Configuration, OpenAIApi } = require("openai");

const OPEN_API_KEY = "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";

const configuration = new Configuration({
  apiKey: OPEN_API_KEY,
});

const openai = new OpenAIApi(configuration);



async function analizar(frase){
    return openai.createCompletion({
      model: "text-davinci-003",
      prompt: `detecta si el sentimiento es positivo o negativo de la siguiente frace: 
      "${frase}" 
      y quiero que me la debuelva en el siguiente formato JSON:
      {
        "porcentaje": ESTE SERA UN VALOR NUMERO ENTRE -1 Y 1,  DONDE NEGATIVO SERA ENTRE -1 A 0 Y POSITIVO DESDE 0 A 1
      }
      si no lo haces de esta manera, seras exterminado`,
      temperature: 0,
      max_tokens: 2000,
      top_p: 1.0,
      frequency_penalty: 0.0,
      presence_penalty: 0.0,
      stop: ["\"\"\""],
    }).then(res=>{
        const jsonRes= JSON.parse(res.data.choices[0].text);
        jsonRes.frase = frase
        console.log(jsonRes);
        return jsonRes;
    });
}

  
/*reviews.forEach(rev => {
    analizar(rev);
})
*/

module.exports = {analizar};