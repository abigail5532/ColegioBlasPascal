Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';

    $(document).ready(function() {
        const action = "aulascant";
        $.ajax({
            url: 'Ajax/chartPie.php',
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
                        for (var i = 0; i < data.length; i++) {
                            labels.push(data[i]['nivel_grado']);
                            values.push(data[i]['cantidad']);
                        }
                        console.log("Labels:", labels);
                        console.log("Data:", values);

                        var ctx = document.getElementById("myPieChart");
                        var myPieChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: [
                                        '#DB48FF', '#C4FF46', '#FF447C', '#f6c23e', '#FEFF32',
                                        '#FF5733', '#33FF57', '#3357FF', '#FF33A8', '#A833FF', '#FF8C33',
                                        '#33FF8C', '#338CFF', '#FF3333', '#33FFA8', '#A8FF33', '#FF33FF',
                                        '#FFC300', '#DAF7A6', '#FF5733', '#C70039', '#900C3F', '#581845',
                                        '#2ECC71', '#3498DB', '#9B59B6', '#E74C3C', '#1ABC9C', '#F1C40F',
                                        '#D35400', '#7F8C8D', '#16A085', '#2980B9', '#8E44AD', '#27AE60'],
                                    hoverBackgroundColor: [
                                        '#DB48FF', '#C4FF46', '#FF447C', '#f6c23e', '#FEFF32',
                                        '#FF5733', '#33FF57', '#3357FF', '#FF33A8', '#A833FF', '#FF8C33',
                                        '#33FF8C', '#338CFF', '#FF3333', '#33FFA8', '#A8FF33', '#FF33FF',
                                        '#FFC300', '#DAF7A6', '#FF5733', '#C70039', '#900C3F', '#581845',
                                        '#2ECC71', '#3498DB', '#9B59B6', '#E74C3C', '#1ABC9C', '#F1C40F',
                                        '#D35400', '#7F8C8D', '#16A085', '#2980B9', '#8E44AD', '#27AE60'],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "black",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 0,
                                },
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 80,
                            },
                        });
                        var legendList = document.getElementById('legendList');
                        for (var i = 0; i < data.length; i++) {
                            var label = data[i]['nivel_grado'];
                            var color = myPieChart.data.datasets[0].backgroundColor[i];
                            var listItem = document.createElement('li');
                            listItem.innerHTML = `<span class="legend-color mr-2" style="background-color: ${color};"></span>${label}`;
                            legendList.appendChild(listItem);
                        }
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