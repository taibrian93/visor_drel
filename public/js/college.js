$('.populationCenter').select2();

var meta = $("meta[name='csrf-token']").attr("content");
$('.delete').on('click', function(e){
    e.preventDefault();
    var college = $(this).attr('college');
    var url = window.location.origin+''+window.location.pathname;
    
    Swal.fire({
        title: '¿Estas seguro de realizar esta acción?',
        text: "¡Una vez eliminado, no podrá recuperar este registro!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar registro!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url+"/"+college,
                type: 'DELETE',             
                data: {
                    '_token' : meta,
                    'college' : college
                },
                success: function(results) {

                    
                    window.location = window.location.href;
                 
                    
                    
                },
                cache: false
            });
            
        }
    })
});

$('.province').on('change', function(){
    $('.district').empty();
    $('.populationCenter').empty();
    var urlHost = window.location.protocol + '//' + window.location.host + '/dashboard/getDistrict';
    var val = $(this).val();
    $('.district').append(`<option>Cargando...</option>`)
    $.ajax({
        url: urlHost,
        type: 'POST',
        data: {
            '_token': meta,
            'codigoUbigeo' : val,
        },
        success: function (results) {
            console.log(results);
            $('.district').empty();
            $('.district').append(`<option>Seleccione Distrito...</option>`)
            for (var i = 0; i < results.length; i++){
                $('.district').append(`<option value="${results[i].codigoUbigeo}">${results[i].descripcion} - ${results[i].codigoUbigeo}</option>`)
            }
            
        },
        cache: false
    });
});

$('.district').on('change', function(){
    $('.populationCenter').empty();
    var urlHost = window.location.protocol + '//' + window.location.host + '/dashboard/getPopulationCenter';
    var val = $(this).val();
    $('.populationCenter').append(`<option>Cargando...</option>`)
    $.ajax({
        url: urlHost,
        type: 'POST',
        data: {
            '_token': meta,
            'codigoUbigeo' : val,
        },
        success: function (results) {
            console.log(results)
            $('.populationCenter').empty();
            $('.populationCenter').append(`<option>Seleccione Centro Poblado...</option>`)
            for (var i = 0; i < results.length; i++){
                $('.populationCenter').append(`<option value="${results[i].codigoCentroPobladoMINEDU}">${results[i].descripcion} - ${results[i].codigoCentroPobladoMINEDU}</option>`)
            }
        },
        cache: false
    });
});