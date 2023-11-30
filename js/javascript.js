// ===========  System Alerts   ===========

function showAlert() {

    const urlParams = new URLSearchParams(window.location.search);
    const alert = urlParams.get('alert');

    if (alert === '1') {
      const alertContainer = document.getElementById('alert');
      alertContainer.style.display = 'block';

      setTimeout(() => {
        closeAlert();
      }, 15000);
    }
  }

  function closeAlert() {
    // Hide the alert
    const alertContainer = document.getElementById('alert');
    alertContainer.style.display = 'none';
  }

// ===========  User Action  ===========

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
