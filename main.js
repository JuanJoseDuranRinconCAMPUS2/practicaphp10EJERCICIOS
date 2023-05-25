// Construir el algoritmo en Javascript para un programa
// para cualquier cantidad de estudiantes que lea el nombre,
// el sexo y la nota definitiva y halle al estudiante con la mayor
// nota y al estudiante con la menor nota y cuantos eran
// hombres y cuantos mujeres.

let myFormUsuarios = document.querySelector("#myFormUsuarios");
// 
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
    let res = await (await fetch("procesos.php", config)).text();
    console.log(res);
    if (res) {        
        try {
            var resJS = JSON.parse(res);
            console.log(resJS);
            document.querySelector("#tableContent").innerHTML = `
            <tr>
                <th>Mejor Calificacion</th>
                <td>${resJS.max.Nombre}</td>
                <td>${resJS.max.Genero}</td>
                <td>${resJS.max.Nota}</td>
            </tr>
            <tr>
                <th>Peor Calificacion</th>
                <td>${resJS.min.Nombre}</td>
                <td>${resJS.min.Genero}</td>
                <td>${resJS.min.Nota}</td>
            </tr>
            `;
            document.querySelector("#tableContentMyF").innerHTML = `
            <tr>
                <th>Cantidad Mujeres</th>
                <td>${resJS.CountMyF.CountF}</td>
            </tr>
            <tr>
                <th>Cantidad Hombres</th>
                <td>${resJS.CountMyF.CountM}</td>
            </tr>
            `;  
        } catch (error) {
            document.querySelector("#tableContent").innerHTML = `
            <tr>
                <th>ERRROR</th>
                <td>Datos</td>
                <td>De entrada</td>
                <td>Incorrectos</td>
            </tr>
            `; 
            document.querySelector("#tableContentMyF").innerHTML = `
            <tr>
                <th>Error</th>
                <td>Data incorrecta</td>
            </tr>
            <tr>
                <th>Error</th>
                <td>Data incorrecta</td>
            </tr>
            `;  
        }
       
    }else{
        console.log("error");
    }
});
