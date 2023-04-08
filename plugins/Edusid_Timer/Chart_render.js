// too: queries maken die de data ophaalt en deze doorgeven aan de renderChart functie
// en de updateChart functie
// selector aanpassen en queries o.b.v. selector
// queries vanuit class callen
// queries maken o.b.v de geselecteerde klas
// stippellijn toevoegen aan de chart vanaf een de 1 na laatse datum

function renderChart(data) 
{
    var options = {
        chart: {
            type: 'line',
            height: 350,
            width: 350
        },
        series: [{
            name: 'grade',
            data: data
        }],
        xaxis: {
            categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep']
        },
        yaxis: {
            categories: [0,1,2,3,4,5,6,7,8,10]
        }
    }
    var chart = new ApexCharts(document.getElementById('pupil-dashboard-chart'), options);
    chart.render();
    
    return chart;
}

function UpdateChart(data, chart) 
{
    var chart = new ApexCharts(document.getElementById('pupil-dashboard-chart'), options);    
    chart.updateSeries(data);
}


var options = {
    chart: {
        type: 'line',
        height: 350,
        width: 350
    },
    series: [{
        name: 'grade',
        data: [4.5,5.5,6.5,6,4,5,8,9,7]
    }],
    xaxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep']
    },
    yaxis: {
        categories: [0,1,2,3,4,5,6,7,8,10]
    }
}

var chart = new ApexCharts(document.getElementById('pupil-dashboard-chart'), options);
chart.render();


chart.updateSeries([{
    name: 'grade',
    data: [1,2,3,4]
}]);



  