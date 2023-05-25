//N atletas han pasado a finales en salto triple en los juegos
// olímpicos femenino de 2022. Diseñe un programa que pida por
// teclado los nombres de cada atleta finalista y a su vez, sus
// marcas del salto en metros. Informar el nombre de la atleta
// campeona que se quede con la medalla de oro y si rompió
// récord, reportar el pago que será de 500 millones. El récord
// esta en 15,50 metros.

let myFormUsuarios = document.querySelector("#myFormUsuarios");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormUsuarios.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    let res = await (await fetch("api.php", config)).text();
    document.querySelector("#content").innerHTML = res;
    document.querySelector("#button").innerHTML = '<input type="submit" value="Hecho"></input>';
});

let myFormNombres = document.querySelector("#myFormNombres");

myFormNombres.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    let res = await (await fetch("atletasCalculo.php", config)).text();
    console.log(res);
    try {
        var resJS = JSON.parse(res);
        console.log(resJS);
        document.querySelector("#tableContent").innerHTML = `
            <tr id="contenidoPersona">
                <th>Medalla De Oro</th>
                <td>${resJS.MedallaDeOro.Nombre}</td>
                <td>${resJS.MedallaDeOro.Marca}</td>
                <td>${resJS.Premiacion}</td>
            </tr>
        `;
    } catch (error) {
        document.querySelector("#tableContent").innerHTML = `
            <tr id="contenidoPersona">
                <th>Error</th>
                <td>Revisa</td>
                <td>la</td>
                <td>data</td>
            </tr>
        `;
    }
});
