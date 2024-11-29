Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

function number_format(number, decimals, dec_point, thousands_sep) {
  var n = number.toFixed(decimals).toString().split('.');
  n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
  return n.join(dec_point);
}

if (document.getElementById("myBarChart")) {
  const action = "alumnosPorAula";
  $.ajax({
    url: 'Ajax/chartBar.php',
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
          labels.push(data[i]['nivel_grado']);
          values.push(parseInt(data[i]['cantidad_alumnos']));
        }
        console.log("Labels:", labels);
        console.log("Data:", values);

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: "Cantidad de Alumnos",
              backgroundColor: "#f6c23e",
              hoverBackgroundColor: "#f6c23e",
              borderColor: "#f6c23e",
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
                  maxTicksLimit: 6
                },
                maxBarThickness: 25,
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
