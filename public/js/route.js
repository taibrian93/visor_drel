var meta = $("meta[name='csrf-token']").attr("content");
$('.selectResult').select2();

$(window).on('keydown', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
})

$('.searchFilter').on('change', function(){
    $('.searchInput').val('');
})

$('.searchInput').keyup(function () {
    if($('.searchFilter').val() != 1){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    }
});

$('.searchCollege',).on('click', function () {
    
    urlHost = window.location.protocol + '//' + window.location.host + '/dashboard/route/getColleges';
    dataFilter = $('.searchFilter').val();
    input = $('.searchInput').val();

    if(input.length > 1){
        $.ajax({
            url: urlHost,
            type: 'POST',
            data: {
                '_token': meta,
                'filter': dataFilter,
                'data': input,
            },
            success: function (results) {
                console.log(results);
                if(results.length > 0){
                    $('.selectResultCopy ').addClass('d-none');
                    //$('.searchInput').addClass('d-none');
                    //$('.selectResult').removeClass('d-none');
                    $('.select2').removeClass('d-none');
                    $('.btn-route').prop("disabled", false);
                    $('.deleteResultSeacrh').prop("disabled", false);
                    $('.selectResult').empty();

                    for (var i = 0; i < results.length; i++){
                        $('.selectResult').append(`<option value="${results[i].id}">${results[i].province} - ${results[i].district} -  ${results[i].population_center} - ${results[i].nombreCentroEducativo}</option>`)
                    }
                } else{
                    Swal.fire({
                                    
                        text: "¡No se encontró este registro en la base de datos!",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        
                    })
                }
            },
            cache: false
        });
    }
});

$('.deleteResultSeacrh').on('click', function(){
    $('.searchInput').removeClass('d-none');
    $('.select2').addClass('d-none');
    $('.selectResultCopy ').removeClass('d-none');
    // $('.selectResult').select2();
    // $('.selectResult').select2('destroy');
    $('.btn-route').prop("disabled", true);
    $('.deleteResultSeacrh').prop("disabled", true);
    $('.searchInput').val('');
});


$('.delete').on('click', function (e) {
    e.preventDefault();
    var route = $(this).attr('route');

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
                url: window.location.href + "/" + route,
                type: 'DELETE',
                data: {
                    '_token': meta,
                    'route': route
                },
                success: function (results) {


                    window.location = window.location.href;



                },
                cache: false
            });

        }
    })
});