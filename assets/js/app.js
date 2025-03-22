$(document).ready(function(){
$('#programadores').DataTable({ language: {
            "lengthMenu": "  _MENU_ Programadores por pagina",
            "zeroRecords": "No hay registros",
            "searchPlaceholder": "Buscar por Tecnologia",
            "info": "Registros del _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
            },
            }});


    $('#logout-link').on('click', function(e) {
        e.preventDefault();
        
        var confirmation = confirm("¿Estás seguro de que deseas salir?");
        
        if (confirmation) {
            window.location.href = $(this).attr('href');
        }
    });


});

function getData()
{

    $.ajax({
        url:"filtros/getTecno",
        success:function(resp){
            $("#reportes-modal .modal-body").html(resp);
             //alert(resp);
        }

    });

}   



