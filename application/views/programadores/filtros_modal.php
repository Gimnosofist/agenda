<style type="text/css">
  
  #resultados {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  border-collapse: collapse;
  width: 50%;
  }

  #resultados td, #resultados th {
  border: 1px solid #ddd;
  padding: 0px;
  }

  #resultados td{
  text-align: center;
  }

  #resultados tr:nth-child(even){background-color: #f2f2f2;}

  #resultados tr:hover {background-color: #ddd;}

  #resultados th {
  padding-top: 1px;
  padding-bottom: 1px;

  text-align: center;
  background-color: #646464;
  color: white;

</style>

<div class="row">
    <div id="divTecnologias" class="col-md-2 reportes-box">
        <div align="right"><button type="button" id="btnFiltrar" class="btn btn-success w-2 btn-sm">Filtrar</button></div>
        <label>Desde:</label> 
        <input class="form-control" type="date" name="desde" id="desde">
        <label>Hasta:</label>
        <input class="form-control" type="date" name="hasta" id="hasta">

        <hr>

        <h6>Tecnologías:</h6>
        <?php foreach($tecnologias as $tecno): ?>
            <div class="list-group-item checkbox">
                <label><input class="tecnologias-checkbox" type="checkbox" id="checkboxTecno" value="<?php echo $tecno->id;?>" > <?php echo $tecno->tecnologia;?></label>
            </div>
        <?php endforeach;?>
    </div>

    <div id="" class="col-md-9 reportes-box filtroData">
        <h5>Resultados  <code><a href="#" onclick="limpiartabla()">Limpiar</a></code></h5>
        <hr>
        <div class="col-md-8">
        <table id="resultados" border="" class="display compact table-bordered" style="width:100%;">

            <tbody>
                
            </tbody>
        </div>
        </table>
    </div>
</div>

<script>
  jQuery(document).ready(function() {
    let hoy = new Date();
    let anio = hoy.getFullYear();
    let mes = String(hoy.getMonth() + 1).padStart(2, '0'); 
    let dia = String(hoy.getDate()).padStart(2, '0'); 
    let fechaHoy = `${anio}-${mes}-${dia}`; 

    $("#desde, #hasta").attr("max", fechaHoy);

    $("#desde").on("change", function ()
     {
        let fechaDesde = $(this).val();
        $("#hasta").attr("min", fechaDesde);
    });

    $("#hasta").on("change", function () 
    {
        let fechaHasta = $(this).val();
        $("#desde").attr("max", fechaHasta);
    });

    jQuery("#btnFiltrar").click(function() 
    {
        var tecnologias_seleccionadas = [];
        var desde = jQuery("#desde").val();
        var hasta = jQuery("#hasta").val();

        jQuery(".tecnologias-checkbox:checked").each(function() {
            tecnologias_seleccionadas.push(jQuery(this).val()); 
        });

        jQuery.ajax({
            url: 'filtros/fitrar',
            type: 'POST',
            dataType: 'json',  
                        data: {
                desde: desde,
                hasta: hasta,
                tecnologias: tecnologias_seleccionadas
            },
            success: function(response) {
                if(response.status === 'error') {
                    alert(response.message); 
                } else {
                    let registros = response;
                    let html = "<table style='max-width: 100%; overflow-x: auto;' id='resultados' class='display compact table-bordered' style='width:100%''><thead>";
                    html += "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Fecha Alta</th><th>Tecnologías</th></tr>";
                    html += "</thead><tbody>";

                    for (var i = 0; i < registros.length; i++) {
                        html += "<tr>";
                        html += "<td>" + registros[i]["id"] + "</td>";
                        html += "<td>" + registros[i]["nombre"] + "</td>";
                        html += "<td>" + registros[i]["apellidos"] + "</td>";
                        html += "<td>" + registros[i]["email"] + "</td>";
                        html += "<td>" + registros[i]["fecha_alta"] + "</td>";
                        html += "<td>" + registros[i]["tecnologias"] + "</td>";
                        html += "</tr>";
                    }

                    html += "</tbody></table>";

                    $("#resultados").html(html);
                }
            },
            error: function(xhr, status, error) {
                alert('Ocurrió un error: ' + error);
            }
        });
    });
});


function limpiartabla()
{
    $("#resultados").html("");
}


</script>
