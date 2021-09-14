var items = [];

//Funcion para eliminar fila
let btncallback = function (e, cell) {
    Swal.fire({
        title: "Advertencia",
        text: "Se elimina este registro, ¿Desea continuar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then(result => {
        if (result.isConfirmed) {
            let row = cell.getRow();
            row.delete();
            updateChangeTable();
        }
    });
};

//funciona para gregar el boton de eliminar fila
let btn = function (value, data, cell, row, options) {
    return `<center><button type="button" class="btn btn-sm btn-secondary" title="Eliminar Fila"> <i class="fa fa-times"></i> </button></center>`;
};

//funciont para actualizar el monto por fila
function updateHour(cell) {
    var alert = '';
    let row = cell.getRow();
    let data = cell.getData();


    let inicio = (isNaN(parseInt(data.hora_inicio))) ? 0 : parseInt(data.hora_inicio);
    let fin = (isNaN(parseInt(data.hora_fin))) ? 0 : parseInt(data.hora_fin);
    // console.log(inicio, 'inicio');
    // console.log(fin, 'fin');

    let resul = ((parseInt(fin) - parseInt(inicio) < 0  || inicio<=0 ) ) ? 0 : (parseInt(fin) - parseInt(inicio));
    // console.log(resul, 'resul');

    row.update({ 'jornada': resul });
    let hoursTotal = fnHoras();
    let valor = $("#auxJornada").val();
    let total = parseInt(valor) - parseInt(hoursTotal);
    $("#_horas").val('' + total);


    //para validar el horario segun horario de carga academica
    if (parseInt(inicio) > 0 && parseInt(fin) > 0){
        if(parseInt(inicio)>=parseInt(fin)){
            alert += `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Horas inválidas, la hora de entrada no puede ser mayor que la hora de salida
                            </div>
                        </div>`;
            row.update({ 'hora_inicio': null });
            row.update({ 'hora_fin': null });
        } else if (!Boolean((data.dia).trim())) {//para validar que este selecciona un Dia por fila
            alert += `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Seleccione un dia para continuar con el registro
                            </div>
                        </div>`;
        } else if (Boolean((data.dia).trim())) {
            $.ajax({
                type: "POST",
                url: '/admin/jornada-check-dia',
                data: {
                    empleado: $("#id_emp").val(),
                    inicio: inicio,
                    fin: fin,
                    dia: data.dia,
                    periodo: $("#id_periodo").val()
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        }
    }

    // para validar el total de las horas
    validateHoras(valor, total);
    $("#days-table").after(alert);
}

//para calcular el total horas por fila
function fnHoras() {
    let dataColumn = table.getColumn('jornada');
    let hourRow = 0;
    $.each(dataColumn.getCells(), function (indexInArray, valueOfElement) {
        hourRow = parseInt(hourRow) + parseInt(valueOfElement._cell.value);
    });
    hourRow = isNaN(hourRow) ? 0 : hourRow;
    return hourRow;
}

//funcion para gregar una nueva fila
$("#btnNewRow").on('click', function () {
    table.addRow({ dia: "", hora_inicio: "", hora_fin: "", jornada: "" }, false);
});

//Create Date Editor
var dateEditor = function (cell, onRendered, success, cancel) {
    //cell - the cell component for the editable cell
    //onRendered - function to call when the editor has been rendered
    //success - function to call to pass the successfuly updated value to Tabulator
    //cancel - function to call to abort the edit and return to a normal cell

    //create and style input
    var cellValue = moment(cell.getValue, "HH:mm").format("HH:mm"),
        input = document.createElement("input");

    input.setAttribute("type", "time");

    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";

    input.value = cellValue;

    onRendered(function () {
        input.focus();
        input.style.height = "100%";
    });

    function onChange() {
        if (input.value != cellValue) {

            if(input.value!==''){
                let alert = '';
                if (parseInt(input.value) >= 18) {
                    alert += `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Ingrese un Hora enferior a las <strong>18:00</strong>
                            </div>
                        </div>`;

                    cancel();
                } else if (parseInt(input.value) <= 6) {
                    alert += `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Ingrese un Hora mayor a las <strong>6:00</strong>
                            </div>
                        </div>`;
                    cancel();
                } else {
                    success(moment(input.value, "HH:mm").format("HH:mm"));
                }
                $("#days-table").after(alert);
            }
        } else {
            cancel();
        }
    }

    //submit new value on blur or change
    input.addEventListener("blur", onChange);

    //submit new value on enter
    input.addEventListener("keydown", function (e) {
        if (e.keyCode == 13) { onChange(); }
        if (e.keyCode == 27) { cancel(); }
    });

    return input;
};
//initialize table
var table = new Tabulator("#days-table", {
    data: items,           //load row data from array
    layout: "fitColumns",      //fit columns to width of table
    responsiveLayout: "hide",  //hide columns that dont fit on the table
    tooltips: true,            //show tool tips on cells
    addRowPos: "top",          //when adding a new row, add it to the top of the table
    history: true,             //allow undo and redo actions on the table
    pagination: false,       //paginate the data
    // paginationSize:7,         //allow 7 rows per page of data
    movableColumns: true,      //allow column order to be changed
    resizableRows: true,       //allow row order to be changed
    initialSort: [             //set the initial sort order of the data
    ],

    columns: [//define the table columns
        // { title: "", field: "id" },
        { title: "", field: "option", formatter: btn, cellClick: btncallback },
        { title: "Dia", field: "dia", editor: "select", validator: ["required", "unique"], editorParams: { values: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"] }, cellEdited: updateHour},
        { title: "Entrada", field: "hora_inicio", hozAlign: "center", sorter: "time", editor: dateEditor,cellEdited: updateHour},
        { title: "Salida", field: "hora_fin", hozAlign: "center", sorter: "time", editor: dateEditor, cellEdited: updateHour},
        { title: "Jornada", field: "jornada", editor: false, validator: "numeric"},
    ],
});


function updateJornada() {
    let hoursTotal = fnHoras();
    let valor = $("#auxJornada").val();
    let total = parseInt(valor) - parseInt(hoursTotal);
    validateHoras(valor, total);
    return total;
}

function validateHoras(valor, total){
    $(".alert-danger").remove();
    valor = parseInt(valor);
    total = parseInt(total);
    var mensaje = '';
    let validado = true;
    let restante = valor-total;

    if (restante>valor) {
        validado = false;
        mensaje = 'Las horas registradas exceden el número de horas permitidas';
    }

    if (mensaje!=='') {
        let alert = `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  ${mensaje}
                            </div>
                        </div>`;

        $("#days-table").after(alert);
    }
    return validado;
}

function updateChangeTable(){
    let total = $(".total-horas").val();
    let updatehours = updateJornada();
    $("#_horas").val(updatehours);
    validateHoras(total, updatehours);
}


// if (items.length) {//para ocultar la culumna del id
//     table.hideColumn("id");
// } else {//para eliminar la columna cuando se este creando un nuevo presupuesto
//     table.deleteColumn("id");
// }

jQuery.validator.addMethod("notEqual", function (value, element, param) {
    return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");

$("#frmJornada").validate({
    rules: {
        id_emp: {
            required: true,
        },
        id_periodo: {
            required: true
        }
    },
    messages:{
        id_emp:{
            required: 'Seleccione un Empleado'
        },
        id_periodo:{
            required: 'Seleccione un Periodo Valido'
        }
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        let alert = '';

        $(".alert-danger").hide();
        $('<input>', {
            type: 'hidden',
            name: 'items',
            value: JSON.stringify(table.getData())
        }).appendTo('#frmJornada');

        let libres = $("#_horas").val();
        let horas = $("#auxJornada").val();
        horas = parseFloat(horas);
        libres = parseFloat(libres);
        // console.log(libres);
        let extra_valid = true;
        if (libres>0){
            alert = `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Complete las <strong>${  horas }</strong> horas de la jornada
                            </div>
                        </div>`;
            extra_valid = false;
        }else if(libres<0){
            alert = `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Ha excedido las <strong>${horas}</strong> horas de la jornada
                            </div>
                        </div>`;
            extra_valid = false;
        }
        $("#days-table").after(alert);

        var valid = table.validate();
        if (valid && extra_valid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: $('#frmJornada').attr('method'),
                url: $('#frmJornada').attr('action'),
                dataType: "JSON",
                data: new FormData(document.getElementById('#frmJornada'.replace('#', ''))),
                processData: false,
                contentType: false,
                error: function (jqXHR, textStatus) {
                    if (jqXHR.status === 0) {
                        errorServer('#notificacion_jornada', 'No conectar: ​​Verifique la red.');
                    } else if (jqXHR.status == 404) {
                        errorServer('#notificacion_jornada', 'No se encontró la página solicitada [404]');
                    } else if (jqXHR.status == 500) {
                        errorServer('#notificacion_jornada', 'Error interno del servidor [500].');
                    } else if (textStatus === 'parsererror') {
                        errorServer('#notificacion_jornada', 'Error al analizar JSON solicitado.');
                    } else if (textStatus === 'timeout') {
                        errorServer('#notificacion_jornada', 'Error de tiempo de espera.');
                    } else if (textStatus === 'abort') {
                        errorServer('#notificacion_jornada', 'Solicitud de Ajax cancelada.');
                    } else {
                        errorServer('#notificacion_jornada', 'Error no detectado: ' + jqXHR.responseText);
                    }
                    $('.modal').scrollTop($('.modal').height());
                }, beforeSend: function (jqXHR, textStatus) {
                    $('#notificacion_jornada').removeClass().addClass('alert alert-info bg-info text-white border-0').html(''
                        + '<div class="row">'
                        + '    <div class="col-lg-1 px-2">'
                        + '        <div class="spinner-border text-white m-2" role="status"></div>'
                        + '    </div>'
                        + '    <div class="col-lg-11 align-self-center" >'
                        + '      <h3 class="col-xl text-white">Cargando...</h3>'
                        + '    </div>'
                        + '</div>'
                    ).show();
                    $('.modal').scrollTop(0);
                    // disableform('#frmJornada');
                },
            }).then(function (data) {
                if (data.error != null) {
                    $('#notificacion_jornada').removeClass().addClass('alert alert-danger bg-danger text-white border-0');
                    $errores = '';

                    let tipo = $.type(data.error);
                    if (tipo === 'string') {
                        $errores = data.error;
                    } else {
                        for (let index = 0; index < data.error.length; index++) {
                            $error = '<li>' + data.error[index] + '</li>';
                            $errores += $error;
                        }
                    }

                    $('#notificacion_jornada').html('<h4 Class = "text-white">Completar Campos:</h4>'
                        + '<div class="row">'
                        + '<div class="col-lg-9 order-firts">'
                        + '<ul>' + $errores + '</ul>'
                        + '</div>'
                        + '<div class="col-lg-3 order-last text-center">'
                        + '<li class="fa fa-exclamation-triangle fa-5x"></li>'
                        + '</div>'
                        + '</div>'
                    ).show();
                    enableform('#frmJornada');

                } else {
                    if (data.mensaje != null && data.error == null) {
                        $('#notificacion_jornada').removeClass().addClass('alert alert-success bg-success text-white ').html(''
                            + '<div class="row">'
                            + '<div class="col-xl-11 order-last">'
                            + ' <h3 class="col-xl text-white">' + data.mensaje + '</h3>'
                            + '</div>'
                            + '<div class="col-xl-1 order-firts">'
                            + '<i class="fa fa-check  fa-3x"></i>'
                            + '</div>'
                            + '</div>'
                        ).show();
                        $('#frmJornada')[0].reset();
                        location.reload();
                    }
                }
                $('.modal').scrollTop(0);
            });

        }else{
            alert = `<div class="alert alert-danger mt-3" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Información!</strong>  Complete o verifique el contenido de la tabla
                            </div>
                        </div>`;

            $("#days-table").after(alert);
        }
    },
    errorClass: "invalid-feedback",
    validClass: "state-success",
    errorElement: "em",
    highlight: function (element, errorClass, validClass) {
        $(element).closest('.field').addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).closest('.field').removeClass(errorClass).addClass(validClass);
    },
    errorPlacement: function (error, element) {
        if (element.is(":radio") || element.is(":checkbox")) {
            element.closest('.option-group').after(error);
        } else {
            error.insertAfter(element.parent());
        }
    }
});

