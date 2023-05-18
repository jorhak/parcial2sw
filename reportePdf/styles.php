body {
  font-family: "Arial";
}

.logotype{
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
  width: 216mm;
  height: 108mm;
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