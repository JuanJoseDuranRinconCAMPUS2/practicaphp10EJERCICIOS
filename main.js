//Dado un número indicar si es par o impar y si es mayor de 10

let myForm = document.querySelector("#myFormPrimo");
let myTabla = document.querySelector(".tablaNumeros");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormPrimo.addEventListener("submit", async(e)=>{
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
            <th>${resJS.Numero}</th>
            <td>${resJS.Par}</td>
            <td>${resJS.Mayor}</td>
        `;
    }else{
        document.querySelector("#contenido").innerHTML = `
    <th>ERROR</th>
    <th>ERROR</th>
    <th>ERROR</th>

    `;

    }
    
})
