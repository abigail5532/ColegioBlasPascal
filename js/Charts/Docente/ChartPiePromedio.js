Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

$(document).ready(function() {
    const action = "aulascant";
    $.ajax({
        url: 'Ajax/chartPiePromedio.php',
        type: 'POST',
        data: { action: action },
        async: true,
        success: function(response) {
            console.log("Response from server:", response);
            if (response != 0) {
                try {
                    var data = JSON.parse(response);
                    if (data.error) {
                        console.error("Error from server:", data.error);
                        return;
                    }

                    var labels = [];
                    var values = [];
                    var backgroundColors = [];

                    for (var i = 0; i < data.length; i++) {
                        labels.push(`Desaprobados`);
                        values.push(data[i]['cantidad_menor_12']);
                        backgroundColors.push('red');
                        labels.push(`Aprobados`);
                        values.push(data[i]['cantidad_mayor_11']);
                        backgroundColors.push('#71B600');
                    }

                    console.log("Labels:", labels);
                    console.log("Values:", values);

                    var ctx = document.getElementById("PieChartAprobados");
                    var PieChartAprobados = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: backgroundColors,
                                hoverBackgroundColor: backgroundColors,
                                borderColor: "rgba(234, 236, 244, 1)",
                                hoverBorderColor: "rgba(234, 236, 244, 1)"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "black",
                                bodyFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: true,
                                caretPadding: 0,
                            },
                            legend: {
                                display: true, 
                                labels: {
                                    fontSize: 15
                                }
                            },
                        }
                    });
                } catch (e) {
                    console.error("Error parsing JSON:", e);
                }
            }
        },
        error: function(error) {
            console.log("AJAX Error:", error);
        }
    });
});
