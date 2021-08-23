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