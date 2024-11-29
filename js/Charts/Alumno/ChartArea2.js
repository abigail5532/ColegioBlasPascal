// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

function number_format(number, decimals, dec_point, thousands_sep) {
  // Number formatting logic
  var n = number.toFixed(decimals).toString().split('.');
  n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
  return n.join(dec_point);
}

if (document.getElementById("AreaChartAlumno")) {
  const action = "alumnosPorAula";
  $.ajax({
    url: 'Ajax/chartArea.php',
    type: 'POST',
    data: { action: action },
    async: true,
    success: function(response) {
      console.log("Response from server:", response);
      try {
        var data = JSON.parse(response);
        if (data.error) {
          console.error("Error from server:", data.error);
          return;
        }

        var labels = [];
        var values = [];
        for (var i = 0; i < data.length; i++) {
          labels.push(data[i]['nombre_bimestre']);
          values.push(parseInt(data[i]['promediogeneral']));
        }
        console.log("Labels:", labels);
        console.log("Data:", values);

        // Bar Chart Example
        var ctx = document.getElementById("AreaChartAlumno").getContext('2d');
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: "Promedio General",
              lineTension: 0,
              backgroundColor: "rgba(168, 51, 255, 0.1)",
              borderColor: "rgba(168, 51, 255, 1)",
              pointRadius: 3,
              pointBackgroundColor: "rgba(168, 51, 255, 1)",
              pointBorderColor: "rgba(168, 51, 255, 1)",
              pointHoverRadius: 3,
              pointHoverBackgroundColor: "rgba(168, 51, 255, 1)",
              pointHoverBorderColor: "rgba(168, 51, 255, 1)",
              pointHitRadius: 10,
              pointBorderWidth: 2,
              data: values,
            }],
          },
          options: {
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
              }
            },
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  maxTicksLimit: 5,
                  padding: 10,
                  callback: function(value, index, values) {
                    return number_format(value, 0, '.', ',');
                  }
                },
                gridLines: {
                  color: "#C8CAD4",
                  zeroLineColor: "#C8CAD4",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
                }
              }],
            },
            legend: {
              display: false
            },
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: 'black',
              titleFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "black",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              intersect: false,
              mode: 'index',
              caretPadding: 10,
              callbacks: {
                label: function(tooltipItem, chart) {
                  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  var value = chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                  return datasetLabel + ': ' + number_format(value, 0, '.', ',');
                }
              }
            },
          }
        });
      } catch (e) {
        console.error("Error parsing JSON:", e);
      }
    },
    error: function(error) {
      console.log("AJAX Error:", error);
    }
  });
}