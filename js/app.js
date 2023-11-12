"use strict"

const URL = "api/sugerencias/";

let suggestions = [];

let form = document.querySelector('#suggestion-form');
form.addEventListener('submit', insertSuggestion);


//Obtiene todas las sugerencias de la API REST

async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        suggestions = await response.json();

        showSuggestions();
    } catch(e) {
        console.log(e);
    }
}

//Inserta la tarea via API REST
async function insertSuggestion(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let suggestion = {
        titulo: data.get('titulo'),
        genero: data.get('genero'),
        descripción: data.get('descripción'),
        prioridad: data.get('prioridad'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(suggestion)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nsuggestion = await response.json();

        // inserto la tarea nuevo
        suggestions.push(nsuggestion);
        showSuggestions();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteSuggestion(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.suggestion;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        suggestions = suggestions.filter(suggestion => suggestion.id != id);
        showSuggestions();
    } catch(e) {
        console.log(e);
    }
}

function showSuggestions() {
    let ul = document.querySelector("#suggestion-list");
    ul.innerHTML = "";
    for (const suggestion of suggestions) {

        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ suggestion.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${suggestion.titulo}</b> - ${suggestion.descripción} -Genero de tipo ${suggestion.genero} (prioridad ${suggestion.prioridad}) </span>
                <div class="ml-auto">
                    ${suggestion.finalizada != 1 ? `<a href='#' data-suggestion="${suggestion.id}" type='button' class='btn btn-success mybutton btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-suggestion="${suggestion.id}" type='button' class='btn btn-danger mybutton btn-delete'>Eliminar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteSuggestion);
    }
}

getAll();
