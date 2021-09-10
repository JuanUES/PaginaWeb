$('#A_carga').on('change', function() {
    let option = document.getElementById("A_carga").value;
    $.ajax({
        url: 'ver/'+option,
        type: "GET",
        success: function(data){
           data=JSON.parse(data);

            let $select = $('#carga');
            $('#carga').empty();
            for (let index = 0; index < data.length; index++) {
                console.log( data[index]);
                $select.append('<option value=' + data[index].id + '>' + data[index].nombre_carga+
                '</option>');
                
            }
           

        }, 
        error: function(){
              alert("No hay datos");
         }

        }); 
  });




$('.select2-multiple').select2();