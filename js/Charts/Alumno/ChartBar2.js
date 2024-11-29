Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

function number_format(number, decimals, dec_point, thousands_sep) {
  var n = number.toFixed(decimals).toString().split('.');
  n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
  return n.join(dec_point);
}

function filtroBimestres() {
  console.log('filtroBimestres called');
  var bimestre = document.getElementById("bimestre").value;

  $.ajax({
    url: 'Ajax/chartBar.php',
    type: 'POST',
    data: { bimestre: bimestre },
    async: true,
    success: function(response) {
      console.log("Response from server:", response);
      try {
        var data = JSON.parse(response);
        var ctx = document.getElementById("AreaBarAlumno").getContext('2d');

        if (data.error) {
          console.error("Error from server:", data.error);
          return;
        }

        var labels = [];
        var values = [];
        var colors = [];

        for (var i = 0; i < data.length; i++) {
          labels.push(data[i]['asignatura']);
          values.push(parseInt(data[i]['promedio']));
          if (data[i]['promedio'] < 12) {
            colors.push("#FF0000"); // Rojo de 0 a 11
          } else if (data[i]['promedio'] >= 12 && data[i]['promedio'] <= 15) {
            colors.push("#FFDC00"); // Amarillo de 12 a 15
          } else {
            colors.push("#0000FF"); // Azul de 16 a 20
          }
        }

        console.log("Labels:", labels);
        console.log("Data:", values);

        if (window.myBarChart) {
          window.myBarChart.destroy();
        }
        window.myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: "Promedio",
              backgroundColor: colors,
              hoverBackgroundColor: colors,
              borderColor: colors,
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
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 6,
                  maxRotation: 45,
                  minRotation: 45,
                  autoSkip: false,
                  fontSize: 10
                },
                barThickness: 15,
                maxBarThickness: 30,
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
                  color: "rgb(189, 191, 200 )",
                  zeroLineColor: "rgb(189, 191, 200 )",
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

document.addEventListener('DOMContentLoaded', function() {
  filtroBimestres();
});
