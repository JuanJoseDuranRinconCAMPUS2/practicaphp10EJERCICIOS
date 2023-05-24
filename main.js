// Construir el algoritmo que solicite el nombre y edad de 3
// personas y determine el nombre de la persona con mayor edad.}

let myFormMayor = document.querySelector("#myFormMayor");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormMayor.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    let res = await (await fetch("api.php", config)).text();
    console.log(res);

    if (res) {
        var resJS = JSON.parse(res);
        console.log(resJS);
        document.querySelector(".myTablaPersonas").innerHTML = `
            <tr id="contenidoPersona">
                <th>${resJS.Persona1.Nombre}</th>
                <td>${resJS.Persona1.Edad}</td>
            </tr>
            <tr id="contenidoPersona">
                <th>${resJS.Persona2.Nombre}</th>
                <td>${resJS.Persona2.Edad}</td>
            </tr>
            <tr id="contenidoPersona">
                <th>${resJS.Persona3.Nombre}</th>
                <td>${resJS.Persona3.Edad}</td>
            </tr>
        `;
        document.querySelector(".myTablaMayor").innerHTML = `
            <tr id="contenidoPersona">
                <th>${resJS.Mayor.Nombre}</th>
                <td>${resJS.Mayor.Edad}</td>
            </tr>
        `;
    }else{
        let tbodys = document.querySelectorAll("#contenidoPersona");
        tbodys.forEach(element => {
            element.innerHTML = `
            <th>ERROR</th>
            <th>ERROR</th>
            `;
        });   
    }
    
})