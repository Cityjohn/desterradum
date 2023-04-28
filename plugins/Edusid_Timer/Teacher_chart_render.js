// todo: 
// queries maken die de data ophaalt en deze doorgeven aan de renderChart functie
// en de updateChart functie
// selector aanpassen en queries o.b.v. selector
// queries vanuit class callen
// queries maken o.b.v de geselecteerde klas

// The teacher chart is constrained at 350px by the div, changing this affects offset values

var options = {
	
    chart: {
        height: 600,
        type: 'area',
        zoom: {enabled: true},
        toolbar: {show: true},
    
      },
    
    // Datalabels on the line
    
    dataLabels: {
        enabled: true
    },
    
    // The datapoints, should be fetched
        
    series: [{
        name: 'nowcast',
        data: [2, 3, 4.2, 5, 6],
      }, {
        name: 'forecast',
        data: [5.5, 6.2, 5.7, 6.2, 6],
		
    }],
	
	
    
    // Fill paramters such as Gradient for area charts
    
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.4,
          opacityTo: 0.6,
          stops: [0, 50, 70]
        }
      },
    
    // sequential colors for series
      colors:['#FF2200', '#0364D7'],
    
    // how many data points are dotted lines, this should be computed from days until exam with projected grades
	forecastDataPoints: {
		count: 1
	},
    
    // width of the graph
      stroke: {
        width: 5,
        curve: 'smooth'
      },
    
        
    // X axis formatting rules
        
      xaxis: {
        type: 'datetime',
        categories: ['11-01-2023', '11-02-2023', '11-03-2023', '11-04-2023', '11-05-2023', '11-06-2023'],
        tickAmount: 5,
        labels: {
          formatter: function(value, timestamp, opts) {
            return opts.dateFormatter(new Date(timestamp), 'dd MMM')
          },
			  style: {
				  fontWeight: 600,
				  fontSize: '16px',
				  fontFamily: 'dosis',
				},
        }
      },
        
    // Y axis formatting rules
        
      yaxis: {
        min: 0,
        max: 10,
        tickAmount: 10,
            labels: {
                show: false,
				style: {
				  fontWeight: 600,
				  fontSize: '16px',
				  fontFamily: 'dosis',
				},
            }
        },
    
    
    // Annotation lines and labels
    annotations: {
        
        // Y axis annotations (is only 1 possible?)
        
          yaxis: [
        {
          y: 6,
          strokeDashArray: 0,
          offsetX: 800,
          width: '0%',
          borderColor: 'black',
          label: {
            borderColor: 'white',
            style: {
              color: 'black',
              background: 'white',
              fontWeight: 600,
			  fontSize: '18px',
			  fontFamily: 'dosis',
            },
            text: '6.0',
			
            offsetX: -150,
			offsetY: 10,
          }
        }
      ],
        
      // X axis annotations
    
      xaxis: [
        {
          x: new Date('11-05-2023').getTime(),
          borderColor: 'black',
          strokeDashArray: 0,
          label: {
            style: {
              color: 'black',
              background: 'white',
              fontWeight: 600,
			  fontSize: '18px',
            },
            text: 'Exam', 
			fontFamily: 'dosis',
            orientation: "horizontal",
          }
        }
      ],
        
        // Point annotations (for showing current day/current grade on today's date) Needs algorithm to determine todays grade for y position
        
//         points: [
//           {
//             x: new Date('11-04-2023').getTime(),
//             y: 5,
//             marker: {
//               size: 6,
//               fillColor: "#FF2200",
//               strokeColor: "#FF2200",
//               radius: 2
//             },
//           }
//         ]
    },
    
	// Legend parameters
	
	legend: {
      show: true,
      showForSingleSeries: false,
	  position: 'bottom',
      horizontalAlign: 'center',
	  fontSize: '20px',
//       fontFamily: 'Helvetica, Arial',
	  fontFamily: 'dosis',
      fontWeight: 600,
		
	itemMargin: {
          horizontal: 25,
          vertical: 25
      },
	},
	
    };



    
    // render chart in DOM element ID = pupil-dashboard-chart
    
    var chart = new ApexCharts(document.getElementById('teacher-dashboard-chart'), options);
    chart.render();
    
    
    // For updating when switching datasets i.e physics or mathematics.
    
    // chart.updateSeries([{
    //     name: 'grade',
    //     data: [1,2,3,4]
    // }]);