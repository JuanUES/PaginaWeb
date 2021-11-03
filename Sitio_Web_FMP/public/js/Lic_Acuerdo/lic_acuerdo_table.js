
    let table;
    //BOTON DE EDITAR
    function editar(boton) {
        
        //alert($(boton).val());
        if($(boton).val()!=null){
            
             $.ajax({
                 type: "GET",
                 url: 'LicenciasAcuerdo/edit/'+$(boton).val(),
                 beforeSend: function() {
                     $(boton).prop('disabled', true).html(''
                         +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                     );
                 },
                 success: function(json) {   
                     var json = JSON.parse(json);  
                    // console.log(json);
                     $('#idPermiso').val(json.id);                   
                     $('#justificacion').summernote("code",json.justificacion);
                  
                     $('#empleado').val(json.empleado).trigger("change");
                     $('#tipo_permiso').val(json.tipo_permiso).trigger("change");
                     $('#fecha_de_inicio').val(json.fecha_uso);
                     $('#fecha_final').val(json.fecha_presentacion);                                   
                   
                     $("#modalRegistro").modal();
                 },
                 complete: function(json) {
                     $(boton).prop('disabled', false).html(''
                         +'<i class="fa fa-edit font-16 py-1" aria-hidden="true"></i>'
                     );
                 }
             });                
        }
     }
    //para la tabla

        table = $("#Lic-table").DataTable({
            "language": {
                "decimal": ".",
                "emptyTable": "No hay datos para mostrar",
                "info": "Del _START_ al _END_ (_TOTAL_ total)",
                "infoEmpty": "Del 0 al 0 (0 total)",
                "infoFiltered": "(Filtrado de todas las _MAX_ entradas)",
                "infoPostFix": "",
                "thousands": "'",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No hay resultados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Ordenar de manera Ascendente",
                    "sortDescending": ": Ordenar de manera Descendente ",
                }
            },
            "responsive": true,
            "autoWidth": false,
            "deferRender": true,
            "ajax": {
                "url": "/admin/LicenciasAcuerdo/tabla",
                "method": "GET",
                "dataSrc": function (json) {
                  //  console.log(json);

                    if (json) {
                        for (let i = 0, ien = json.length; i < ien; i++) {
                            //CREAMOS UNA NUEVA PROPIEDAD LLAMADA BOTONES
                            html = "";
                            html += '<td>';
                            html += '    <div class="btn-group">';
                            html += '        <button title="Editar" type="button" name="' + json[i].id + '"  value="' + json[i].id + '"   onclick="editar(this)" class="btn btn-outline-primary btn-sm rounded" data-toggle="modal"';
                            html += '            data-target="#modal-editar">';
                            html += '            <i class="fas fa-edit py-1 font-16"></i>';
                            html += '        </button>';
                            /* <button title="Editar"  onclick="editar({{$item->id}},this)">
                                         <i class="fa fa-edit py-1 font-16" aria-hidden="true"></i>
                                     </button>*/

                            html += '    </div>';
                            html += '</td>';
                            json[i]["botones"] = html;

                        }

                        return json;
                    } else {

                        return [];
                    }
                }
            },
            columns: [
                { data: "e_nombre" },
                { data: "tipo_permiso" },
                { data: "inicio" },
                { data: "fin" },
                { data: "justificacion" },
                { data: "botones" },
            ]
        });

