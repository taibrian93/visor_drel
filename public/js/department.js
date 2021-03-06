$('.populationCenter').select2();

$('.codigoUbigeo').keyup(function () {
    this.value = (this.value + '').replace(/[^0-9]/g, '');
});

var meta = $("meta[name='csrf-token']").attr("content");
$('.delete').on('click', function(e){
    e.preventDefault();
    var department = $(this).attr('department');
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
                url: url+"/"+department,
                type: 'DELETE',             
                data: {
                    '_token' : meta,
                    'department' : department
                },
                success: function(results) {

                    
                    window.location = window.location.href;
                 
                    
                    
                },
                cache: false
            });
            
        }
    })
});  