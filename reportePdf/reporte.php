<?php
ob_start();
$mysqli = new mysqli("localhost", "root", "", "agencia_viajes");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
$sql = "SELECT * FROM paquete WHERE id=" . $_GET["idpaquete"];
$result = $mysqli->query($sql);
// Associative array
$row = $result->fetch_assoc();
echo $row["nombre"];
echo $row["origen"];
echo $row["destino"];


$sql2 = "SELECT * FROM cliente WHERE id=" . $_GET["idcliente"];
$result2 = $mysqli->query($sql2);
// Associative array
$row2 = $result2->fetch_assoc();
// Free result st

// http://localhost/reportePdf/reporte.php?idpaquete=1&idcliente=11

$aeropuerto = "Aeropuerto International de Sur";
if ($row["origen"] == "santa cruz" || $row["origen"] == "Santa Cruz") {
  $aeropuerto = "Aeropuerto Internacional de Viru Viru";
}

if ($row["origen"] == "tarija" || $row["origen"] == "Tarija") {
  $aeropuerto = "Aeropuerto Internacional Oriel Lea Plaza";
}

if ($row["origen"] == "la paz" || $row["origen"] == "La Paz") {
  $aeropuerto = "Aeropuerto Internacional El Alto";
}

if ($row["origen"] == "potosi" || $row["origen"] == "Potosi") {
  $aeropuerto = "Aeropuerto Internacional La Joya Andina";
}
?>
<html charset="UTF-8">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="robots" content="noindex">
</head>

<body>
  <div class="document">
    <table cellspacing="0" cellpadding="0">
      <tr class="topLine">
        <td class="bankLogo">
          <img src="http://localhost/reportePdf/logo-title.png" class="logotype" width="20px" height="120px" alt="">
        </td>
        <td class="sideBorders center"><span style="font-size:24px;font-weight:bold;">341-7</span></td>
        <td class="boletoNumber center"><strong>NRO. BOLETO: </strong> <span>930 - 3214523645 </span></td>
      </tr>
    </table>
    <table cellspacing="0" cellpadding="0" border="1">

      <tr>
        <td width="20%" colspan="6">
          <span class="title">LUGAR DE SALIDA</span>
          <br />
          <span class="text"> <?php echo $aeropuerto; ?></span>
        </td>
        <td width="50%" colspan="7">
          <span class="title">FECHA DE VENCIMIENTO</span>
          <br />
          <br />
          <p class="content right text"">01/06/2023</p>
        </td>
      </tr>

      <tr>
        <td width=" 70%" colspan="6">
            <span class="title">NOMBRE DEL BENEFICIARIO / CEDULA DE IDENTIDAD:</span>
            <br />
          <table border="0" style="border:none">
            <tr>
              <td width="60%"><span class="text"><?php echo $row2["nombre"]; ?></span></td>
              <td><span class="text">CI: <?php echo $row2["ci"]; ?> SC</span></td>
            </tr>
          </table>
          <br />
        </td>
        <td width="30%" colspan="7">
          <span class="title">CODIGO DEL BENEFICIARIO</span>
          <br />
          <br />
          <p class="content right"><?php echo "SC001-" . $row2["ci"]; ?></p>
        </td>
      </tr>

      <tr>
        <td width="25%" colspan="2">
          <span class="title">FECHA DE COMPRA</span>
          <br />
          <p class="content center">11/05/2023</p>
        </td>
        <td width="17%" colspan="2">
          <span class="title">PAQUETE:</span>
          <br />
          <p class="content center"><?php echo $row["nombre"]; ?></p>
        </td>
        <td width="17%" colspan="2">
          <span class="title">FECHA DE SALIDA</span>
          <br />
          <p class="content center"><?php echo $row["fecha_salida"]; ?></p>
        </td>
        <td width="20%" colspan="7">
          <span class="title">DESDE: </span>
          <br />
          <p class="content center"><?php echo $row["origen"]; ?></p>
        </td>

      </tr>

      <tr>
        <td width="15%">
          <span class="title">ASCIENTO</span>
          <br />
          <p class="content center">7</p>
        </td>
        <td width="10%">
          <span class="title">VUELO</span>
          <br />
          <p class="content center">341</p>
        </td>
        <td width="17%" colspan="2">
          <span class="title">DURACION</span>
          <br />
          <p class="content center"><?php echo $row["duracion"]; ?></p>
        </td>
        <td width="17%" colspan="2">
          <span class="title">FECHA LLEGADA</span>
          <br />
          <p class="content center">25-05-2023</p>
        </td>
        <td width="30%" colspan="7">
          <span class="title"> DESTINO: </span>
          <br />
          <br />
          <p class="content center"><?php echo $row["destino"]; ?></p>
        </td>
      </tr>

      <tr>
        <td colspan="6" rowspan="4">
          <span class="title">Todo tramite de reprogramacion es de forma personal. </span>
        </td>
      </tr>

      <tr>
        <td colspan="7">
          <table border="0" style="border:none">
            <tr>
              <td width="60%"><span class="text"><b>NOMBRE COMPRADOR: </b> <?php echo $row2["nombre"] ?></span></td>
              <td><span class="text"><b>Nit/Ci: </b> <?php echo $row2["ci"]; ?> </span></td>
            </tr>
          </table>

        </td>

      </tr>
    </table>
    <br />
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZYAAAAyCAYAAAB/Av3aAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAABVvSURBVHhejYoBCiQHDMP6/09frxQNwmtnRhCMFf/zlz//4eRWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9V/6I51Y3l+fo5vIcnVze5A7SZ4I9Z9Z/7WDtnf7D5Vdy5vJOsOdWN+nZtt3yTrDnVjerN8+tblrPfXZyeWPPmda9W/u2c4f1/7qD9Cuhdc7Qnd6R8LZLD61fO6d3JKwdrH/rTmido2f6D5cn/Vf+iOdWN5fn6ObyHJ1c3uQO0meCPWfWf+1g7Z3+w+VXcubyTrDnVjfp2bbd8k6w51Y3qzfPrW5az312cnljz5nWvVv7tnOH9f+6g/QroXXO0J3ekfC2Sw+tXzundySsHax/605onaNn+g+XJ/1X/ojnVjeX5+jm8hydXN7kDtJngj1n1n/tYO2d/sPlV3Lm8k6w51Y36dm23fJOsOdWN6s3z61uWs99dnJ5Y8+Z1r1b+7Zzh/X/uoP0K6F1ztCd3pHwtksPrV87p3ckrB2sf+tOaJ2jZ/oPlyf9/z///PkXZb/t1fffG7EAAAAASUVORK5CYII=" alt="">
    <br />
    <br />
    <br />
  </div>
</body>
<style>
  body {
    font-family: "Arial";
  }

  .logotype {
    width: 100%;
  }

  @media print {

    .no-print,
    .no-print * {
      display: none !important;
    }
  }

  .document {
    margin: auto auto;
    width: 100%;
    height: 95%;
    background-color: #fff;
  }

  .headerBtn {
    margin: auto auto;
    width: 216mm;
    background-color: #fff;
    display: none;
  }

  table {
    width: 100%;
    position: relative;
    border-collapse: collapse;
  }

  .bankLogo {
    width: 40%;
  }

  .boletoNumber {
    width: 40%;
    font-weight: bold;
  }

  .center {
    text-align: center;
  }

  .right {
    text-align: right;
    right: 20px;
  }

  td {
    position: relative;
  }

  .title {
    position: absolute;
    left: 0px;
    top: 0px;
    font-size: 12px;
    font-weight: bold;
  }

  .borde {
    left: 0px;
    top: 0px;
  }

  .text {
    font-size: 12px;
  }

  p.content {
    padding: 0px;
    width: 100%;
    margin: 0px;
    font-size: 12px;
  }

  .sideBorders {
    border-left: 1px solid black;
    border-right: 1px solid black;
  }

  hr {
    size: 1;
    border: 1px dashed;
  }

  br {
    content: " ";
    display: block;
    margin: 12px 0;
    line-height: 12px;
  }

  .print {
    /* TODO(dbeam): reconcile this with overlay.css' .default-button. */
    background-color: rgb(77, 144, 254);
    background-image: linear-gradient(to bottom, rgb(77, 144, 254), rgb(71, 135, 237));
    border: 1px solid rgb(48, 121, 237);
    color: #fff;
    text-shadow: 0 1px rgba(0, 0, 0, 0.1);
  }

  .btnDefault {
    font-kerning: none;
    font-weight: bold;
  }

  .btnDefault:not(:focus):not(:disabled) {
    border-color: #808080;
  }

  button {
    border: 1px;
    padding: 5px;
    line-height: 20px;
  }



  i[class*=icss-] {
    position: relative;
    display: inline-block;
    font-style: normal;
    background-color: currentColor;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    vertical-align: middle
  }

  i[class*=icss-]:after,
  i[class*=icss-]:before {
    content: "";
    border-width: 0;
    position: absolute;
    -webkit-box-sizing: border-box;
    box-sizing: border-box
  }

  i.icss-print {
    width: .68em;
    height: 1em;
    border-style: solid;
    border-color: currentcolor;
    border-width: .07em;
    -webkit-border-radius: .05em;
    border-radius: .05em;
    background-color: transparent;
    margin: 0 .17em
  }

  i.icss-print:before {
    width: 1em;
    height: .4em;
    border-width: .07em .21em 0;
    border-style: solid;
    border-color: currentColor currentcolor transparent;
    -webkit-border-radius: .05em .05em 0 0;
    border-radius: .05em .05em 0 0;
    top: .25em;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, transparent), color-stop(20%, currentcolor), color-stop(60%, currentcolor), color-stop(60%, transparent));
    background-image: -webkit-linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%);
    background-image: -o-linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%);
    background-image: linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%)
  }

  i.icss-print:after {
    width: .45em;
    height: .065em;
    background-color: currentColor;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    top: .6em;
    -webkit-box-shadow: 0 .12em, -.1em -.28em 0 .05em;
    box-shadow: 0 .12em, -.1em -.28em 0 .05em
  }

  i.icss-files {
    width: .75em;
    height: .95em;
    background-color: transparent;
    border: .05em solid transparent;
    border-width: 0 .05em .05em 0;
    -webkit-box-shadow: inset 0 0 0 .065em, .13em .11em 0 -.05em;
    box-shadow: inset 0 0 0 .065em, .13em .11em 0 -.05em;
    -webkit-border-radius: 0 .3em 0 0;
    border-radius: 0 .3em 0 0;
    margin: 0 .17em .05em .1em
  }

  i.icss-files:before {
    border-style: solid;
    border-width: .2em;
    top: .037em;
    left: .25em;
    -webkit-border-radius: .1em;
    border-radius: .1em;
    border-color: transparent currentColor transparent transparent;
    -webkit-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg)
  }
</style>

</html>

<?php
$html = ob_get_clean();

require 'vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set('isRemoteEnabled', TRUE);
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('8.5x11', 'landscape');
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("ticket.pdf", array("Attachment" => true));

?>