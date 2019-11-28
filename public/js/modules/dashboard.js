var centralalarme = centralalarme || {};

centralalarme.dasboard = (function() {

    let chart = function(id, value, colors) {
        Circles.create({
            id: id,
            radius: 45,
            value: value,
            maxValue: value,
            width: 5,
            text: value,
            colors: colors,
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        });
    };

    let statisticsChart = function(attendances) {
        let ctx = document.getElementById('statisticsChart').getContext('2d');
        _statisticsChart(attendances, ctx);
    };

    let _statisticsChart = function(attendances, ctx) {
        let result = [];

        $.each(attendances, function(index, value) {
            result.push({
                label: value.name,
                borderColor: value.color_hex,
                pointBackgroundColor: "rgba("+value.color_rgb+", 0.6)",
                pointRadius: 2,
                backgroundColor: "rgba("+value.color_rgb+", 0.4)",
                legendColor: value.color_hex,
                fill: true,
                borderWidth: 2,
                data: value.months
            });
        });

        let statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                datasets:
                    result
            },
            options : {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                layout:{
                    padding:{left:5,right:5,top:15,bottom:15}
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function(chart) {
                    let text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (let i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });

        let myLegendContainer = document.getElementById("myChartLegend");

        // generate HTML legend
        myLegendContainer.innerHTML = statisticsChart.generateLegend();

        // bind onClick event to all LI-tags of the legend
        let legendItems = myLegendContainer.getElementsByTagName('li');
        for (let i = 0; i < legendItems.length; i += 1) {
            legendItems[i].addEventListener("click", legendClickCallback, false);
        }

    };

    return {
        chart,
        statisticsChart
    }

}());
