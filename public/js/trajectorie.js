$('.puntoLlegada').select2();

$('.checkDestinoFinal').on('change', function(){
    if ($('.checkDestinoFinal').is(':checked')) {
        $('.puntoLlegada').prop('disabled', true);
        $('.destinoFinal').prop('disabled', false);
        $('.province').prop('disabled', true);
        $('.district').prop('disabled', true);
    } else {
        $('.puntoLlegada').prop('disabled', false);
        $('.destinoFinal').prop('disabled', true);
        $('.province').prop('disabled', false);
        $('.district').prop('disabled', false);
    }
});

var meta = $("meta[name='csrf-token']").attr("content");
$('.delete').on('click', function(e){
    e.preventDefault();
    var trajectorie = $(this).attr('trajectorie');
    var url = window.location.origin+'/dashboard/trajectorie';
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
                url: url+"/"+trajectorie,
                type: 'DELETE',             
                data: {
                    '_token' : meta,
                    'trajectorie' : trajectorie
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
    $('.puntoLlegada').empty();
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
    $('.puntoLlegada').empty();
    var urlHost = window.location.protocol + '//' + window.location.host + '/dashboard/getPopulationCenterDestination';
    var val = $(this).val();
    var routeIdCollege = $(this).attr('routeIdCollege');
    var routeId = $(this).attr('routeId');
    $('.puntoLlegada').append(`<option>Cargando...</option>`)
    console.log(routeIdCollege)
    $.ajax({
        url: urlHost,
        type: 'POST',
        data: {
            '_token': meta,
            'codigoUbigeo' : val,
            'routeIdCollege' : routeIdCollege,
            'routeId' : routeId,          
        },
        success: function (results) {
            console.log(results)
            $('.puntoLlegada').empty();
            $('.puntoLlegada').append(`<option>Seleccione Centro Poblado...</option>`)
            for (var i = 0; i < results.length; i++){
                $('.puntoLlegada').append(`<option value="${results[i].id}">${results[i].descripcion}</option>`)
            }
        },
        cache: false
    });
});