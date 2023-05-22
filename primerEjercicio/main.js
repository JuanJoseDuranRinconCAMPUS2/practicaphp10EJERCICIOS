// Construir el algoritmo para un programa que ingrese tres
// notas de un alumno, si el promedio es menor o igual a 3.9
// mostrar un mensaje "Estudie“, de lo contrario un mensaje que
// diga "becado"

let myForm = document.querySelector("#myForm");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myForm.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    let res = await (await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML = res;
    console.log(res);
})

