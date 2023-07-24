function showEditForm(){

    var $editForm = document.getElementById('editForm');
    $editForm.style.display = 'block';

}

function showNewCodeForm(){

    var $editForm = document.getElementById('newCodeForm');
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

function confirmForm(){

    $formName = documentt.getElementsByClassName('edit-button');
    $name = $formName.name;

    if ($name == "newClient") {
        
        return confirm("Tem certeza de que deseja adicionar novo usuário?");

    } else if($name == "editClient"){

        return confirm("Tem certeza de que deseja alterar o usuário?");
    
    } else if($name == "newCode"){

        return confirm("Tem certeza de que deseja adicionar novo código?");
    
    }


}

document.addEventListener('DOMContentLoaded', function() {
    hideEditForm();
    hideNewCodeForm();
})
