//funciones de menu desplegable----------------------------------
function toggleSidebar() {
    document.getElementById("sidebar").style.width = "250px";
}

function closeSidebar() {
    document.getElementById("sidebar").style.width = "0";
}


let employees = [];

function toggleSidebar() {
    document.getElementById("sidebar").style.width = "250px";
}

function closeSidebar() {
    document.getElementById("sidebar").style.width = "0";
}
//funcion de seccionesss ----------------------------------
function showPage(page) {
    fetch(page)
        .then(response => response.text())
        .then(html => {
            document.getElementById('content').innerHTML = html;
        });
}



// inicio funcionalidad-------------------------------------------------------------------


function cargarEstadisticas() {
    // Aquí deberías hacer llamadas AJAX o similares para obtener los datos reales del servidor
    document.getElementById('usuariosEmpresasCount').innerText = '123'; // Ejemplo de valor
    document.getElementById('usuariosEmpleadosCount').innerText = '456'; // Ejemplo de valor
    document.getElementById('usuariosNormalesCount').innerText = '789'; // Ejemplo de valor
    document.getElementById('visitantesNoRegistradosCount').innerText = '101'; // Ejemplo de valor
    document.getElementById('totalVisitasCount').innerText = '1469'; // Ejemplo de valor
}

// Llama a la función para cargar las estadísticas al cargar la página
document.addEventListener('DOMContentLoaded', cargarEstadisticas);