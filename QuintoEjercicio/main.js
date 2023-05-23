// Construir el algoritmo que lea por teclado dos números,
// si el primero es mayor al segundo informar su suma y
// diferencia, en caso contrario, informar el producto y la
// división del primero respecto al segundo.

let myFormOperaciones = document.querySelector("#myFormOperaciones");
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormOperaciones.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    let res = await (await fetch("api.php", config)).text();
    if (res) {
        var resJS = JSON.parse(res);
        console.log(resJS);
        switch (resJS.Mayor) {
            case resJS.Numero1:
                document.querySelector("#myTablaNumeros").innerHTML = `
                <thead>
                <tr>
                    <th scope="row">Numero1</th>
                    <th scope="row">Numero2</th>
                    <th>Primera Operacion</th>
                    <th>Resultado(-)</th>
                    <th>Segunda Operacion</th>
                    <th>Resultado(+)</th>
                </tr>
                </thead>
                <tbody class="tablaNumeros" > 
                    <th>${resJS.Numero1}</th>
                    <th>${resJS.Numero2}</th>
                    <td>-</td>
                    <td>${resJS.Operaciones.Operacion1}</td>
                    <td>+</td>
                    <td>${resJS.Operaciones.Operacion2}</td>
                </tbody>
                `;
            break;
            case resJS.Numero2:
                document.querySelector("#myTablaNumeros").innerHTML = `
                <thead>
                <tr>
                    <th scope="row">Numero1</th>
                    <th scope="row">Numero2</th>
                    <th>Primera Operacion(*)</th>
                    <th>Resultado</th>
                    <th>Segunda Operacion(/)</th>
                    <th>Resultado</th>
                </tr>
                </thead>
                <tbody class="tablaNumeros" > 
                    <th>${resJS.Numero1}</th>
                    <th>${resJS.Numero2}</th>
                    <td>*</td>
                    <td>${resJS.Operaciones.Operacion1}</td>
                    <td>/</td>
                    <td>${resJS.Operaciones.Operacion2}</td>
                </tbody>
                `;
            break;
        }
        
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