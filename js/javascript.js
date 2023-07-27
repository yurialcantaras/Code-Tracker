function showEditForm(){

    var $editForm = document.getElementById('editForm');
    $editForm.style.display = 'block';

}

function showNewCodeForm(){

    var $editForm = document.getElementById('newCodeForm');
    $editForm.style.display = 'block';

}

function showDeleteClientForm(){

    var $editForm = document.getElementById('deleteClientForm');
    $editForm.style.display = 'block';

}

function hideEditForm(){

    var $editForm = document.getElementById('editForm');
    $editForm.style.display = 'none';

}

function hideNewCodeForm(){

    var $editForm = document.getElementById('newCodeForm');
    $editForm.style.display = 'none';

}

function hideDeleteClientForm(){

    var $editForm = document.getElementById('deleteClientForm');
    $editForm.style.display = 'none';

}

function confirmForm(){

    return confirm("Tem certeza de que deseja prosseguir?");

}

document.addEventListener('DOMContentLoaded', function() {
    hideEditForm();
    hideNewCodeForm();
    hideDeleteClientForm();
})
