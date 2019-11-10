function getForm(form, id) {
    var form = document.getElementById(form);
    form.action = form.action+id;
    form.submit();
}
