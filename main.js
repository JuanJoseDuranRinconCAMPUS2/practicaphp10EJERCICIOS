// Desarrolle un programa cíclico que capture un dato
// numérico cada vez, y los vaya acumulando. El programa se
// detiene cuando el usuario digita un cero. El programa debe
// mostrar: LA SUMATORIA DE LOS VALORES, EL VALOR DEL
// PROMEDIO, CUÁNTOS VALORES FUERON DIGITADOS, MAYOR
// VALOR Y MENOR VALOR.

let myFormNumero = document.querySelector("#myFormNumero");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}
let conjunto = [];

myFormNumero.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    conjunto.push(data);
    config.body = JSON.stringify(conjunto);
    let res = await (await fetch("api.php", config)).text();
    console.log(res);
    try {
        var resJS = JSON.parse(res);
        console.log(resJS);
    
        var numeros = resJS.Num.map(item => item.Numero);
        var numerosString = numeros.join(", ");
        console.log(numerosString);
        document.querySelector("#tableContent").innerHTML = `
            <tr>
                <th scope="col">Operaciones</th>
                <td>${numerosString}</td>
                <td>${resJS.operacionD.Suma}</td>
                <td>${resJS.operacionD.Promedio}</td>
                <td>${resJS.operacionD.lengthDatos}</td>
                <td>${resJS.operacionD.Max}</td>
                <td>${resJS.operacionD.Min}</td>
            </tr>
        `;
    } catch (error) {
        document.querySelector("#tableContent").innerHTML = `
            <tr id="contenidoPersona">
                <th>Error</th>
                <td>para ver la data</td>
                <td>Digita el</td>
                <td>numero 0</td>
                <td>ademas recuerda</td>
                <td>Poner la data</td>
                <td>requerida</td>


            </tr>
        `;
    };
});
