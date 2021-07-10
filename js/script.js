function validar_checked(codigo) {
    id = "chec" + codigo;
    idspan = "span" + codigo;

    var span = document.getElementById(idspan);
    var checkBox = document.getElementById(id);

    span.classList.toggle('checked');

    checked = false;
    if (checkBox.checked == false) {
        checked = true;
    }

    data = new FormData()
    data.set('id', codigo)
    data.set('checked', checkBox.checked)

    let request = new XMLHttpRequest();
    request.open("POST", 'DB/marcarTarefa.php', true);
    let res = request.send(data)

    console.log('Olá muindo');
    console.log(res);
}

function AdicionarTexto() {
    const input = document.getElementById('add_new_text');
    input.focus();
    input.select();
}

/*Não usado ainda*/
function excluir() {
      result = confirm("Excluir?");
      if (result == true) {
      console.log('remover');
  }
}