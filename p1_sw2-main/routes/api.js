const express = require('express');
const router = express.Router();
const DF = require('../dialogFlow');
const mysql = require('../database/mysql');
const intentName = require("../assets/intentsDF");
const sentimentAnalyzer = require("../sentimentAnalyzer");

/* GET home page. */
router.get('/', async function (req, res, next) {
	DF.getRespuesta("hola")
		.then(respuesta => {
			//console.log(respuesta);
			/*mysql.query("select * from cliente", (err, rows) => {
				if (err) throw err;
				console.log(rows);
			});*/
			res.json(respuesta);
		})
		.catch(err => {
			console.error(err);
			res.status(500).json('Error!! en dialogflow');
		})
});

let nc;
let nv;

function getName(listName) {
	let nombre = "";
	listName.forEach(e => {
		console.log(e.structValue.fields.name.stringValue);
		nombre += e.structValue.fields.name.stringValue + " ";
	});
	return nombre;
}

router.get('/mensaje', async function (req, res, next) {
	let mensaje = req.query.text;
	let idCliente = req.query.idCliente;
	let idPaquete = req.query.idPaquete;
	//console.log(mensaje);
	//console.log(idCliente);
	//console.log(idPaquete);
	
	DF.getRespuesta(mensaje)
		.then(async respuesta => {
			//console.log(respuesta);

			switch (respuesta.intentName) {
				case intentName.SOLICITAR_SERVICIO:
					let destino = respuesta.parameters.destino.stringValue;
					//console.log(destino);
					(await mysql).query(`SELECT * FROM paquete WHERE destino = '${destino}'`)
						.then(([rows, fields]) => {
							//console.log(rows);
							respuesta.paquetes = rows;
							console.log(respuesta);
							res.json(respuesta);
						})
						.catch(err => {
							console.log("paso algo " + respuesta.intentName);
							console.error(err);
							res.json(err);
						});
					//res.json({error: "error solicitar servicio"});
					break;
				case intentName.ELEGIR_PAQUETE:
					nv = respuesta.parameters.numberValue;
					(await mysql).query(`INSERT INTO cliente (nombre, correo, ci) VALUES (' ', ' ', ' ')`)
						.then(([rows, fields]) => {
							console.log(rows);
							respuesta.idCliente = rows.insertId;
							respuesta.idPaquete = nv;
							res.json(respuesta);
						})
						.catch(err => {
							console.log("paso algo " + respuesta.intentName);
							console.error(err);
							res.json(err);
						});

					break;
				case intentName.PEDIR_NOMBRE:
					let listName = respuesta.parameters.person.listValue.values;
					//console.info(listName[0].structValue);
					let nombre = getName(listName);
					console.log(nombre);
					(await mysql).query(`UPDATE cliente SET ?  WHERE id=?`, [{ nombre: nombre }, idCliente])
						.then(([rows, fields]) => {
							console.log(rows);
							respuesta.idCliente = idCliente;
							respuesta.idPaquete = idPaquete;
							console.log(respuesta);
							res.json(respuesta);
						})
						.catch(err => {
							console.log("paso algo Elegir_paquete");
							console.error(err);
							res.json(err);
						});

					break;
				case intentName.PEDIR_CI:
					let ci = respuesta.parameters.ci.numberValue;
					console.info(respuesta);
					(await mysql).query(`UPDATE cliente SET ?  WHERE id=?`, [{ ci: ci }, idCliente])
						.then(([rows, fields]) => {
							console.log(rows);
							respuesta.idCliente = idCliente;
							respuesta.idPaquete = idPaquete;
							res.json(respuesta);
						})
						.catch(err => {
							console.log("paso algo Elegir_paquete");
							console.error(err);
							res.json(err);
						});
					break;
				case intentName.PEDIR_CORREO:
					let correo = respuesta.parameters.correo.stringValue;
					console.info(respuesta);
					(await mysql).query(`UPDATE cliente SET ?  WHERE id=?`, [{ correo: correo }, idCliente])
						.then(([rows, fields]) => {
							console.log(rows);
							respuesta.idCliente = idCliente;
							respuesta.idPaquete = idPaquete;
							res.json(respuesta);
						})
						.catch(err => {
							console.log("paso algo Elegir_paquete");
							console.error(err);
							res.json(err);
						});

					break;
				case intentName.SALUDO:
					res.json(respuesta);
					break;

				default:
					res.json({ response: "no te endiendo" });
					break;
			}
		})
		.catch(err => {
			console.error(err);
			res.status(500).json('Error!! en dialogflow');
		});
});

router.post('/review', async function (req, res, next) {
	sentimentAnalyzer.analizar(req.body.frase)
	.then(async jsonRes => {
		console.log(jsonRes);
		jsonRes.id_paquete = req.body.id_paquete;
		jsonRes.nombre_cliente = req.body.nombre_cliente;
		(await mysql).query(`INSERT INTO resenas SET ?`, jsonRes)
			.then(([rows, fields]) => {
				console.log(rows);
				res.json({ res: true });
			})
			.catch(err => {
				console.log("paso algo no se pudo insertar \ndata:");
				console.log(req.doby);
				console.error(err);
				res.json(err);
			});		
	})
});

module.exports = router;
