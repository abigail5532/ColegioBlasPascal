document.addEventListener("DOMContentLoaded", function () {
    $('#tblBlasPascal').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ]
    });
    $('#tblFree').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        }
    });
    $(".eliminarconfirmar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de eliminar este registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    })
})
function limpiar() {
    $('#formulario')[0].reset();
    $('#id').val('');
    $('#btnAccion').val('Registrar');
}