// variabile d'appoggio 
let activeForm = null;

// raccolgo la modale
const modal = document.getElementById('modal');
const modalBody = modal.querySelector('.modal-body');
const modalTitle = modal.querySelector('.modal-title');
const modalConfirmButton = modal.querySelector('.confirmation-button');


const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', e => {
        //impedisco l'invio
        e.preventDefault();

        //compilo i dati
        modalConfirmButton.innerText = 'Conferma';
        modalConfirmButton.classList.add('btn-danger');
        modalTitle.innerText = 'Eliminazione Profilo';
        modalBody.innerText = 'Sei sicuro di voler cancellare questo Profilo?';

        // mi segno il form cliccato
        activeForm = form;
    });
});
modalConfirmButton.addEventListener('click', () => {
    if (activeForm) activeForm.submit();
});

modal.addEventListener('hidden.bs.modal', () => {
    activeForm = null;
});