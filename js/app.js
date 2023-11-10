"use strict"

const URL = "api/sugerencias/";

let tasks = [];

let form = document.querySelector('#task-form');
form.addEventListener('submit', insertTask);


//Obtiene todas las sugerencias de la API REST

async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        tasks = await response.json();

        showTasks();
    } catch(e) {
        console.log(e);
    }
}

//Inserta la tarea via API REST
async function insertTask(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let task = {
        titulo: data.get('titulo'),
        genero: data.get('genero'),
        descripción: data.get('descripción'),
        prioridad: data.get('prioridad'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(task)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nTask = await response.json();

        // inserto la tarea nuevo
        tasks.push(nTask);
        showTasks();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteTask(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.task;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        tasks = tasks.filter(task => task.id != id);
        showTasks();
    } catch(e) {
        console.log(e);
    }
}

async function finalizeTask(e) {
    e.preventDefault();
    
    const id = e.target.dataset.task;
    const taskToFinalize = tasks.find(task => task.id == id);

    // Verificar si se encontró la tarea
    if (taskToFinalize) {
        // Mostrar un cuadro de diálogo de confirmación
        const confirmMessage = `¿Deseas finalizar la tarea "${taskToFinalize.titulo}"?`;
        const confirmed = window.confirm(confirmMessage);

        if (confirmed) {
            // Realizar una solicitud a la API REST para finalizar la tarea
            try {
                const response = await fetch(URL + id, {
                    method: 'PUT', // O usa PATCH si prefieres actualizar parcialmente
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ finalizada: 1 })
                });

                if (!response.ok) {
                    throw new Error('Error del servidor');
                }

                // Actualizar la tarea en el arreglo global de sugerencias
                const index = tasks.findIndex(task => task.id == id);
                if (index !== -1) {
                    tasks[index].finalizada = 1; // Marcar la tarea como finalizada
                }

                showTasks(); // Actualizar la lista de sugerencias
            } catch (error) {
                console.log(error);
            }
        }
    }
}


function showTasks() {
    let ul = document.querySelector("#task-list");
    ul.innerHTML = "";
    for (const task of tasks) {

        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ task.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${task.titulo}</b> - ${task.descripción} -Genero de tipo ${task.genero} (prioridad ${task.prioridad}) </span>
                <div class="ml-auto">
                    ${task.finalizada != 1 ? `<a href='#' data-task="${task.id}" type='button' class='btn btn-success mybutton btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-task="${task.id}" type='button' class='btn btn-danger mybutton btn-delete'>Eliminar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteTask);
    }

    const btnsFinalizar = document.querySelectorAll('a.btn-finalize');
    for (const btnFinalizar of btnsFinalizar) {
        btnFinalizar.addEventListener('click', finalizeTask);
    }
}

getAll();
