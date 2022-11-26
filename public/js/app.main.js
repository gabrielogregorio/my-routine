function AdicionarTexto() {
    const input = document.getElementById('add_new_text');
    input.focus();
    input.select();
}

function checkTask(taskID) {
    'use strict';

    let checkID = 'chec' + taskID;
    let spanID = 'span' + taskID;
    let isChecked = false;

    let span = document.getElementById(spanID);
    let checkbox = document.getElementById(checkID);

    span.classList.toggle('checked');

    if (isChecked === false) isChecked = true;

    let formData = new FormData();
    formData.set('taskID', taskID);
    formData.set('checked', checkbox.checked);

    let request = new XMLHttpRequest();
    request.open('POST', '../../process/task/check_task.php', true);
    request.send(formData);
}
