<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group col-12 col-sm-4 mb-3 {{ $errors->has('empleado') ? 'is-invalid' : ''}}">
            <label for="empleado" class="control-label">{{ 'Empleado' }} <span class="text-danger">*</span> </label>
            <input class="form-control" name="empleado" type="text" id="empleado" value="{{ isset($jornada->empleado) ? $jornada->empleado : ''}}" placeholder="">
            {!! $errors->first('empleado', '<p class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group col-12 col-sm-4 mb-3 {{ $errors->has('periodo') ? 'is-invalid' : ''}}">
            <label for="periodo" class="control-label">{{ 'Periodo' }} <span class="text-danger">*</span> </label>
            <input class="form-control" name="periodo" type="text" id="periodo" value="{{ isset($jornada->periodo) ? $jornada->periodo : ''}}" placeholder="">
            {!! $errors->first('periodo', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group col-12 col-sm-6 offset-sm-6 mb-3 {{ $errors->has('start') ? 'is-invalid' : ''}}">
            <label for="thoras" class="control-label">{{ 'tHoras' }} <span class="text-danger">*</span></label>
            <label for="horas" class="control-label">{{ 'Horas' }} <span class="text-danger">*</span>{{ isset($jornada->horas) ? $invoice->horas : ''}}</label>
            {!! $errors->first('horas', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<h5 class="mt-3">Details</h5>
<hr>
<div id="budget-table"></div>
<button type="button" class="btn btn-sm btn-primary mt-3" id="btnNewRow"> <i class="fa fa-plus-square"></i>   New Line </button>

<br><br>

<!--<div class="row">
    <div class="form-group col-12 col-sm-8 mb-3">
        <label for="memo" class="control-label">{{ 'Observations' }}</label>
        <textarea class="form-control" name="memo" type="text" id="memo" placeholder="Observations" rows="3">{{ isset($invoice->memo) ? $invoice->memo : ''}}</textarea>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Sub Total</th>
                    <th id="_subtotal">${{ isset($invoice) ? number_format($invoice->amount()[0]->total, 2) : '0.00' }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td style="background-color: #f4eb9a;" id="_total">
                        ${{ isset($invoice) ? number_format( $invoice->amount()[0]->total+($invoice->amount()[0]->total*($invoice->percentage/100)) , 2) : '0.00' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>-->

<div class="form-group float-end">
    <a href="{{ url('/invoices') }}" title="Back"><button type="button" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    <button type="submit" class="btn btn-primary" >{!! $formMode === 'edit' ? '<i class="fa fa-edit"></i>' : '<i class="fa fa-save"></i>' !!} {{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
</div>


@section('javascripts')

<link rel="stylesheet" href="{{ asset('vendor/tabulator/dist/css/tabulator_simple.css') }}">
<script src="{{ asset('vendor/tabulator/dist/js/tabulator.js') }}"></script>


<script>

    var items = @json(isset($invoice) ? $invoice->items_enabled(true) : []);//set los items del presupuesto
    // console.log(items);
    if(!items.length){//set dos rows vacias para el agregar
        items = [
            {Codigo:1, Dia:"", Entrada:"", Salida:"", Jornada:""},
            {Codigo:1, Dia:"", Entrada:"", Salida:"", Jornada:""},
        ];
    }else{
        //para calcular el monto total por fila al actualizar
        $.each(items, function( index, value ) {
            value.amount = parseFloat(value.price)*parseFloat(value.quantity);
        });
    }



    //Funcion para eliminar fila
    let btncallback = function ( e, cell) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to reverse this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, Delete"
        }).then(result => {
            if (result.isConfirmed) {
                let row = cell.getRow();
                row.delete();

                let subTotal = fnSubTotal();
                $("#_subtotal").html('$'+subTotal.toFixed(2));
                $("#_total").html('$'+subTotal.toFixed(2));

                Toast.fire({
                    icon: "success",
                    title: "Operation carried out successfully."
                });
            }
        });

    };

    //funciona para gregar el boton de eliminar fila
    let btn = function( value, data, cell, row, options ) {
        return `<center><button type="button" class="btn btn-sm btn-secondary" title="Eliminar Fila"> <i class="fa fa-times"></i> </button></center>`;
    };

    //funciont para actualizar el monto por fila
    function  updateAmount(cell) {
        let row = cell.getRow();
        let data = cell.getData();
        row.update({ 'amount': (parseFloat(data.price) * parseFloat(data.quantity)).toFixed(2) });
        //para el calculo automativo del subtotal y el total
        let subTotal = fnSubTotal();
        $("#_subtotal").html('$'+subTotal.toFixed(2));
        $("#_total").html('$'+subTotal.toFixed(2));
    }

    //para calcular el subtotal del monto por fila
    function fnSubTotal(){
        let dataColumn = table.getColumn('amount');
        let amountRow = 0;
        $.each(dataColumn.getCells(), function (indexInArray, valueOfElement) {
            amountRow = parseFloat(amountRow) + parseFloat(valueOfElement._cell.value);
        });
        return amountRow;
    }

    //funcion para gregar una nueva fila
    $("#btnNewRow").on('click', function () {
       table.addRow({code:'', concept:"", unit:"", quantity:"", amount:""}, false);
    });
    //initialize table
   var table = new Tabulator("#budget-table", {
        data: items,           //load row data from array
        layout:"fitColumns",      //fit columns to width of table
        responsiveLayout:"hide",  //hide columns that dont fit on the table
        tooltips:true,            //show tool tips on cells
        addRowPos:"top",          //when adding a new row, add it to the top of the table
        history:true,             //allow undo and redo actions on the table
        pagination: false,       //paginate the data
        // paginationSize:7,         //allow 7 rows per page of data
        movableColumns:true,      //allow column order to be changed
        resizableRows:true,       //allow row order to be changed
        initialSort:[             //set the initial sort order of the data
            {column:"code", dir:"asc"},
        ],            {Codigo:1, Dia:"", Entrada:"", Salida:"", Jornada:""},

        columns:[                 //define the table columns
            {title:"", field:"id"},
            {title:"", field:"option", formatter: btn, cellClick: btncallback, width:100},
            {title:"Codigo", field:"Codigo", editor:"input", validator:"required", width:100},
            {title:"Dia", field:"Dia", editor:"input",validator:"required", width:400},
            {
                title:"Entrada", field:"Entrada", editor:"input",validator: ["required","numeric"],
                cellEdited: updateAmount
            },
            {
                title:"Salida", field:"Salida", editor:"input", validator: ["required","numeric"],
                cellEdited: updateAmount
            },
            {title:"Jornada", field:"Jornada", editor:false,validator:"numeric" },

            // {title:"Gender", field:"gender", width:95, editor:"select", editorParams:{values:["male", "female"]}},
        ],
    });


    if(items.length){//para ocultar la culumna del id
        table.hideColumn("id");
    }else{//para eliminar la columna cuando se este creando un nuevo presupuesto
        table.deleteColumn("id");
    }




     $("#frmInvoice").validate({
        rules: {
            code: {
                required: true
            },
            name: {
                required: true
            },
            start:{
                required: true
            },
            end:{
                required: true
            },
            percentage:{
                required: true
            }
        },
        submitHandler: function() {
            $(".alert-danger").remove();
            $('<input>', {
                type: 'hidden',
                name: 'items',
                value: JSON.stringify(table.getData())
            }).appendTo('#frmInvoice');

            var valid = table.validate();
            if(valid!=true){
                let alert = `<div class="alert alert-danger" role="alert">
                            <div class="alert-message">
                                <strong> <i class="fa fa-info-circle"></i> Information!</strong>  Fill in the table content
                            </div>
                        </div>`;

                $("#budget-table").before(alert);
                return false;
            }
            return true;
        },
        errorElement: "label",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        }
    });

</script>

@endsection
