// Programa que Ingrese por teclado:
// a. el valor del lado de un cuadrado para mostrar por pantalla el
// perímetro del mismo
// b. la base y la altura de un rectángulo para mostrar el área del
// mismo

let myFormCalculo = document.querySelector("#myFormCalculo");
// 
let myHeaders = new Headers({"content-Type": "application/json"});
let config = {
    headers : myHeaders,
}

myFormCalculo.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
    config.method = "POST";
    config.body = JSON.stringify(data);
    console.log(data);
    let res = await (await fetch("api.php", config)).text();
    console.log(res);
    try {
        var resJS = JSON.parse(res);
            console.log(resJS);
            document.querySelector("#tableContent").innerHTML = `
            <tr>
                <th>Perimetro de un Cuadrado</th>
                <td>${resJS.Cuadrado_Lado}</td>
                <td>*</td>
                <td>4</td>
                <td>=</td>
                <td>${resJS.PerimetroCuadrado}</td>
            </tr>
            <tr>
                <th>Area de un Rectangulo</th>
                <td>${resJS.Rectangulo_Base}</td>
                <td>*</td>
                <td>${resJS.Rectangulo_Altura}</td>
                <td>=</td>
                <td>${resJS.AreaRestangulo}</td>
            </tr>
            `;
    } catch (error) {
        document.querySelector("#tableContent").innerHTML = `
            <tr>
                <th>Error</th>
                <td>Mal</td>
                <td>Manejo</td>
                <td>de</td>
                <td>los</td>
                <td>datos</td>
            </tr>
            <tr>
            <th>Error</th>
            <td>Mal</td>
            <td>Manejo</td>
            <td>de</td>
            <td>los</td>
            <td>datos</td>
        </tr>
            `;
    }
});
