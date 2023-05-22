// Construir el algoritmo para determinar el voltaje de un
// circuito a partir de la resistencia y la intensidad de corriente.

let myFormVoltaje = document.querySelector("#myFormVoltaje");
let myTabla = document.querySelector(".tablaResultados");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormVoltaje.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    myTabla.insertAdjacentHTML('beforeend', '<tr id="contenido"></tr>');
    let res = await (await fetch("api.php", config)).text();
    if (res) {
        var resJS = JSON.parse(res);
        console.log(resJS);
        document.querySelector("#contenido").innerHTML = `
            <th>${resJS.Voltaje}</th>
            <th>=</th>
            <th>${resJS.Corriente}</th>
            <th>*</th>
            <th>${resJS.Resistencia}</th>
            `;
    }else{
        document.querySelector("#contenido").innerHTML = `
    <th>ERROR</th>
    <th>=</th>
    <th>ERROR</th>
    <th>*</th>
    <th>ERROR</th>
    `;

    }
    
})
