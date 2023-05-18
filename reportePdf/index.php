<?php

require 'vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=agencia_viajes', 'root', ''));
//Flight::register('db', 'PDO', array('mysql:host=45.132.157.1;dbname=u300302440_turismo', 'u300302440_agencia', '1IUFbkzFe~9T'));

Flight::route('GET /clientes', function () {
  $query = Flight::db()->prepare("SELECT * FROM `cliente`");
  $query->execute();
  $datos = $query->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($datos);
});

Flight::route('POST /clientes', function () {
  $nombre = Flight::request()->data->nombre;
  $correo = Flight::request()->data->correo;
  $ci = Flight::request()->data->ci;

  $sql = "INSERT INTO cliente VALUES (null, ?, ?,?)";
  $query = Flight::db()->prepare($sql);
  $query->bindparam(1, $nombre);
  $query->bindparam(2, $correo);
  $query->bindparam(3, $ci);
  $query->execute();
  Flight::json(["Cliente Registrado"]);
});

Flight::route('DELETE /clientes', function () {
  $id = Flight::request()->data->id;
  echo $id;
  $sql = "DELETE FROM `cliente` WHERE  id=?";
  $query = Flight::db()->prepare($sql);
  $query->bindParam(1, $id);
  $query->execute();
  Flight::json(["Cliente Borrado"]);
});

Flight::route('PUT /clientes', function () {
  $id = Flight::request()->data->id;
  $nombre = Flight::request()->data->nombre;
  $correo = Flight::request()->data->correo;
  $ci = Flight::request()->data->ci;

  $sql = "UPDATE `cliente` SET `nombre`=?,`correo`=?,`ci`=? WHERE id=?";
  $query = Flight::db()->prepare($sql);
  $query->bindparam(1, $nombre);
  $query->bindparam(2, $correo);
  $query->bindparam(3, $ci);
  $query->bindparam(4, $id);
  $query->execute();
  Flight::json(["Cliente Actualizado"]);
});


Flight::route('GET /paquetes', function () {
  $query = Flight::db()->prepare("SELECT * FROM `paquete`");
  $query->execute();
  $datos = $query->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($datos);
});

Flight::route('GET /resenas/@id', function ($id) {
  $query = Flight::db()->prepare("SELECT frase,porcentaje,nombre_cliente FROM `resenas` WHERE id_paquete =?");
  $query->bindParam(1, $id);
  $query->execute();
  $datos = $query->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($datos);
});

Flight::before('json', function () {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');
  header('Access-Control-Allow-Headers: Content-Type');
});

Flight::start();
