$(
    function() {
   // $('#Lic-table').hide();
    
}
);

//PARA HORA DE SALIDA Y ENTRADA AUTOMATICO
$( "#marcaje" ).change(function() {
    //id de comb
    $mar=document.getElementById('marcaje').value;
   

    // realizar la peticion 
    $.ajax({
        type: "GET",
        url: 'ConstanciaOlvido/EntradaSalida/'+$('#fecha').val(),
        success: function(json) {  

           var json = JSON.parse(json);  
          // console.log(json);
           //alert($mar);
           if($mar=='Entrada'){
               $.each(json,function (i,index) {
                $('#hora').val(index.hora_inicio);
               });
              
           }else if($mar=='Salida'){
            $.each(json,function (i,index) {
                $('#hora').val(index.hora_fin);
               });
              
           }
        },
    });  

  });

//FIN DE HORA DE SALIDA Y ENTRADA AUTOMATICO



    let table;
    //BOTON CANCELAR
    function cancelar(btn) {
        $('#cancelar_id').val($(btn).val());
        $('#modalCancelar').modal();
    }
    //FIN DE CANCELAR
    //BOTON DE EDITAR
    function editar(boton) {
        
        //alert($(boton).val());
        if($(boton).val()!=null){
            
             $.ajax({
                 type: "GET",
                 url: '/admin/ConstanciaOlvido/Modal/'+$(boton).val(),
                 beforeSend: function() {
                     $(boton).prop('disabled', true).html(''
                         +'<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>'
                     );
                 },
                 success: function(json) {   
                     var json = JSON.parse(json);  
                    console.log(json);
                    $('#idPermiso').val(json.permiso);
                    $('#fecha').val(json.fecha_presentacion);
                    $('#marcaje').val(json.olvido).trigger("change");
                    $('#hora').val(json.hora_incio);          
                    $('#justificacion').summernote("code",json.justificacion);
                                              
                   
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

        /*table = $("#Lic-table").DataTable({
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
            "autoWidth": true,
            "deferRender": true,
            "ajax": {
                "url": "/admin/ConstanciaOlvido/table",
                "method": "GET",
                "dataSrc": function (json) {
                  //  console.log(json);

                    if (json) {
                        for (let i = 0, ien = json.length; i < ien; i++) {
                            //CREAMOS UNA NUEVA PROPIEDAD LLAMADA BOTONES
                            html = "";
                            html2 = "";
                            inyeccionFecha="";
                            html += '<td>';
                            html += '    <div class="btn-group">';
                            html += '        <button title="Editar" type="button" name="' + json[i].id + '"  value="' + json[i].id + '"   onclick="editar(this)" class="btn btn-outline-primary btn-sm rounded" data-toggle="modal"';
                            html += '            data-target="#modal-editar">';
                            html += '            <i class="fas fa-edit py-1 font-16"></i>';
                            html += '        </button>';
                          

                            html += '    </div>';
                            html += '</td>';
                            json[i]["botones"] = html;
                            
                            html2 += '<span class="badge badge-success">' + json[i].estado+'</span>';
                            json[i]["estado"]=html2;

                        }

                        return json;
                    } else {

                        return [];
                    }
                }
            },
            columns: [
                { data: "fecha" },
                { data: "hora_inicio" },
                { data: "justificacion" },
                { data: "estado" },
                { data: "botones" },
            ]
        });*/


