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
    series: [{
    name: 'Sales',
    data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
  }],
    chart: {
    height: 350,
    type: 'line',
  },
  forecastDataPoints: {
    count: 3
  },
  stroke: {
    width: 5,
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
    tickAmount: 10,
    labels: {
      formatter: function(value, timestamp, opts) {
        return opts.dateFormatter(new Date(timestamp), 'dd MMM')
      }
    }
  },
  title: {
    text: 'Forecast',
    align: 'left',
    style: {
      fontSize: "16px",
      color: '#666'
    }
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      gradientToColors: [ '#FDD835'],
      shadeIntensity: 1,
      type: 'horizontal',
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100, 100, 100]
    },
  },
  yaxis: {
    min: -10,
    max: 40
  }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
//   var chart = new ApexCharts(document.querySelector("#chart"), options);
//   chart.render();


var chart = new ApexCharts(document.getElementById('pupil-dashboard-chart'), options);
chart.render();

// chart.updateSeries([{
//     name: 'grade',
//     data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50],
//     stroke: {
//         curve: 'smooth',
//         dashArray: [0, 8, 5]
//     }

// }]);