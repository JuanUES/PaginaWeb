$(document).ready(function () {
    $('#table-depto').DataTable({
      "language": {
          "decimal":        ".",
          "emptyTable":     "No hay datos para mostrar",
          "info":           "Del _START_ al _END_ (_TOTAL_ total)",
          "infoEmpty":      "Del 0 al 0 (0 total)",
          "infoFiltered":   "(Filtrado de todas las _MAX_ entradas)",
          "infoPostFix":    "",
          "thousands":      "'",
          "lengthMenu":     "Mostrar _MENU_ entradas",
          "loadingRecords": "Cargando...",
          "processing":     "Procesando...",
          "search":         "Buscar:",
          "zeroRecords":    "No hay resultados",
          "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
          },
          "aria": {
            "sortAscending":  ": Ordenar de manera Ascendente",
            "sortDescending": ": Ordenar de manera Descendente ",
          }
        },
          "pagingType": "full_numbers",
          "lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                "iDisplayLength":	5,
    });  
});

function editar(url,id){
  $.get(url+'/Usuario/'+id,function(json){
          json=JSON.parse(json);
          $('#idUser').val(json.id);
          $('#usuario').val(json.name);
          $('#correo').val(json.email);
          $('#empleado').val(json.empleado).trigger('change');
      }
  );
  $.get(url+'/UsuarioRol/'+id,function(json){
          json=JSON.parse(json); 
          var values = [];
          for(var i in json){
              values[i] = json[i].name;
          }
          $('#roles').val(values);
          $('#roles').trigger('change');
          $('#modalRegistro').modal();
         
      }
  );
}