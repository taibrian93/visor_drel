$('.puntoLlegada').select2();

$('.checkDestinoFinal').on('change', function(){
    if ($('.checkDestinoFinal').is(':checked')) {
       $('.puntoLlegada').prop('disabled', true);
       $('.destinoFinal').prop('disabled', false);
    } else {
        $('.puntoLlegada').prop('disabled', false);
       $('.destinoFinal').prop('disabled', true);
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