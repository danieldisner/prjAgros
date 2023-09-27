<div id='janelaPrincipal' title='Gráfico de Totais de Bens por Cliente' style='display: none'>
    <div class='form-dialog-ui'>
        <div class='groupBotoes' id='div_grafico' style='height: 450px'></div>
        <div class='groupBotoes'>
            <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
        </div>
    </div>
</div>
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script>
    
$(function(){
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '60%',
        height: '600',
        modal: true
    });
    
    var arrayObj = [];
    // Requisição AJAX ao servidor para obtenção dos dados
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url('GrafTotalBensCliente/dadosGrafico') ?>',
        dataType: 'json',
        success: function(JSONdata) {
            arrayObj.push(['Cliente', 'Semoventes','Bens Móveis','Imoveis Urbanos','Imoveis Rurais']);
            // Percorre o Array 
            for(var i in JSONdata){
                var nome = JSONdata[i].nome;
                var totalSemoventes = !(JSONdata[i].TotalSemoventes) ? 0 : parseFloat(JSONdata[i].TotalSemoventes);
                var totalImoveisUrbanos = !(JSONdata[i].TotalImoveisUrbanos) ? 0 : parseFloat(JSONdata[i].TotalImoveisUrbanos);
                var totalImoveisRurais = !(JSONdata[i].TotalImoveisRurais) ? 0 : parseFloat(JSONdata[i].TotalImoveisRurais);
                var totalMoveis = !(JSONdata[i].TotalMoveis) ? 0 : parseFloat(JSONdata[i].TotalMoveis);

                arrayObj.push([nome,totalSemoventes,totalMoveis,totalImoveisUrbanos,totalImoveisRurais]);
            }
            google.charts.setOnLoadCallback(drawChart);
        },
        error: function(){
            alert("Ocorreu um erro ao processar a solicitação.");
        }
    });
    google.charts.load('current', {'packages':['bar']});
     
     
    function drawChart() {
        var data = google.visualization.arrayToDataTable(arrayObj);
        var options = {
            chart: {
                title: 'Quantidade de Bens por Cliente (R$)'
            },
            bars: 'vertical',
            height: 400,
            colors: ['#ED2929', '#d95f02', '#4682B4', '#1b9e77'],
            vAxis: {
              title: 'Total',
              format: 'currency',
              scaleType: 'log'              
            }
        };

      var chart = new google.charts.Bar(document.getElementById('div_grafico'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
});
</script>