// var items = @json(isset($jornada) ? $jornada -> items_enabled('activo') : []);//set los items del presupuesto
// // console.log(items);
// if (!items.length) {//set dos rows vacias para el agregar
//     items = [
//         { Dia: "", Entrada: "", Salida: "", Jornada: "" },
//     ];
// } else {
//     //para calcular el monto total por fila al actualizar
//     $.each(items, function (index, value) {
//         value.jornada = parseInt(value.hora_fin) - parseInt(value.hora_inicio);
//     });
// }

var items = [{ option:"", Dia: "", Entrada: "", Salida: "", Jornada: "" },];


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

            let updatehours = updateJornada();
            $("#_horas").val('' + updatehours);
            /*if(updatehours <=0){
                alert("Completo sus horas laborales");
                $("#btnNewRow").hide();
            }
            if(updatehours==0){
                $("#btnSave").show();
            }
            if(updatehours>0){
                $("#btnNewRow").show();
                $("#btnSave").hide();
            }*/

            /*Toast.fire({
                icon: "success",
                title: "Operation carried out successfully."
            });*/
        }
    });

};

//funciona para gregar el boton de eliminar fila
let btn = function (value, data, cell, row, options) {
    return `<center><button type="button" class="btn btn-sm btn-secondary" title="Eliminar Fila"> <i class="fa fa-times"></i> </button></center>`;
};

//funciont para actualizar el monto por fila
function updateHour(cell) {
    let row = cell.getRow();
    let data = cell.getData();

    row.update({ 'jornada': (parseInt(data.hora_fin) - parseInt(data.hora_inicio)) });

    let hoursTotal = fnHoras();
    let aux = $("#auxCalhour").val('' + hoursTotal);
    let valor = $("#auxJornada").val();
    document.getElementById("otro").value = document.getElementById("auxCalhour").value;
    let vat = $("#otro").val();
    let total = parseInt(valor) - parseInt(vat);

    // console.log(vat);
    // console.log(valor);

    $("#_horas").val('' + total);

    /*if(total <=0){
        alert("Completo sus horas laborales");
        $("#btnNewRow").hide();
    }
    if(total==0){
        $("#btnSave").show();
    }
    if(total>0){
        $("#btnNewRow").show();
        $("#btnSave").hide();
    }*/

}

//para calcular el total horas por fila
function fnHoras() {
    let dataColumn = table.getColumn('jornada');
    let hourRow = 0;
    $.each(dataColumn.getCells(), function (indexInArray, valueOfElement) {
        hourRow = parseInt(hourRow) + parseInt(valueOfElement._cell.value);
    });
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
            success(moment(input.value, "HH:mm").format("HH:mm"));
        } else { cancel(); }
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

    columns: [                 //define the table columns
        // { title: "", field: "id" },
        { title: "", field: "option", formatter: btn, cellClick: btncallback },
        { title: "Dia", field: "dia", editor: "select", validator: ["required", "unique"],  editorParams: { values: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"] } },
        {
            title: "Entrada", field: "hora_inicio", hozAlign: "center", sorter: "time", editor: dateEditor,
            cellEdited: updateHour
        },
        {
            title: "Salida", field: "hora_fin", hozAlign: "center", sorter: "time", editor: dateEditor,
            cellEdited: updateHour
        },
        { title: "Jornada", field: "jornada", editor: false, validator: "numeric"},

    ],
});


// if (items.length) {//para ocultar la culumna del id
//     table.hideColumn("id");
// } else {//para eliminar la columna cuando se este creando un nuevo presupuesto
//     table.deleteColumn("id");
// }

jQuery.validator.addMethod("notEqual", function (value, element, param) {
    return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");

$("#frmRegistro").validate({
    rules: {
        dia: {
            required: true,
        },
        hora_inicio: {
            required: true
        },
        hora_fin: {
            required: true
        }
    },
    submitHandler: function () {
        $(".alert-danger").remove();
        $('<input>', {
            type: 'hidden',
            name: 'items',
            value: JSON.stringify(table.getData())
        }).appendTo('#frmJornada');

        var valid = table.validate();
        if (valid != true) {
            let alert = `<div class="alert alert-danger" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Information!</strong>  Fill in the table content
                            </div>
                        </div>`;

            $("#days-table").before(alert);
            return false;
        }
        return true;
    },
    errorElement: "label",
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
    }
});

function updateJornada() {
    let hoursTotal = fnHoras();
    let aux = $("#auxCalhour").val('' + hoursTotal);
    let valor = $("#auxJornada").val();
    document.getElementById("otro").value = document.getElementById("auxCalhour").value;
    let vat = $("#otro").val();
    let total = parseInt(valor) - parseInt(vat);
    // console.log(vat);
    return total;
}
