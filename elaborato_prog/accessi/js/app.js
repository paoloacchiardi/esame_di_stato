$(document).ready(function(){
    $.ajax({
        url: "http://localhost/elaborato_prog/accessi/accessiEventi.php",
        method: "GET",
        success: function(response){
            console.log(response);
            data = JSON.parse(response);
            var nomiEventi = [];
            var numAccessi = [];
            for(var i=0; i<data.length;i++) {
                nomiEventi.push(data[i].nomeEvento);
                numAccessi.push(data[i].numAccessi);
            }
            var chartdata = {
                labels: nomiEventi,
                datasets : [
                    {
                        label: 'Accessi evento',
                        background: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: numAccessi
                    }
                ]
            };

            var ctx = $("#mycanvas");
            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data){
            console.log(data);
        }
    });
});