$(function() {
    $('.select2').select2(
        {    
            tags: "true",
            placeholder: "Seleccione una opciÃ³n",
            allowClear: true,
            width: "100%",
            allowHtml: true,
            dropdownParent: $('#modalRegistro')
        }
    ).select2();
});
