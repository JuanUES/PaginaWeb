

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