var AppChart = function () {
    // Private methods
    var height
    var labelColor
    var borderColor
    var baseColor
    var lightColor
    var element
    var chart
    var year = ''
    var chartData;
    var consultant_total;
    var filtertext;
    var baseColor;
    var baseLightColor;
    var secondaryColor;
    var categories = [];

    const requestData = async function () {
        const formData = new FormData()
        formData.append('year', year);
        formData.append("_token", csrf);
        await fetch(customer_data, {
                method: 'post',
                body: formData
            })
            .then(response => response.json())
            .then((response) => {
                getChartOpion(response)
            })
    }

    function getChartOpion(response) {
        // consultant_total.textContent = data['total']
        let categories = [], Pending = [], Cancelled  = [], Started  = [], Completed  = [], Confirmed  = [], NoShowByCustomer  = [], NoShowByConsultant  = [], Reject  = [], Total = [];
        for (let x in response.chart) {
            Pending
            Cancelled
            Started
            Completed
            Confirmed
            NoShowByCustomer
            NoShowByConsultant
            // Reject
            categories.push(`${x} ${response.chart[x]['year']}`)
            Pending.push(response.chart[x]['data']['Pending'])
            Cancelled.push(response.chart[x]['data']['Cancelled'])
            Started.push(response.chart[x]['data']['Started'])
            Completed.push(response.chart[x]['data']['Completed'])
            Confirmed.push(response.chart[x]['data']['Confirmed'])
            NoShowByCustomer.push(response.chart[x]['data']['NoShowByCustomer'])
            NoShowByConsultant.push(response.chart[x]['data']['NoShowByConsultant'])
            Total.push(response.chart[x]['total'])
        }

        chartData = {
            series: [
                {
                    name: 'Pending',
                    type: 'bar',
                    stacked: true,
                    data: Pending
                },
                {
                    name: 'Cancelled',
                    type: 'bar',
                    stacked: true,
                    data: Cancelled
                },
                {
                    name: 'Confirmed',
                    type: 'bar',
                    stacked: true,
                    data: Confirmed
                },
                {
                    name: 'No Show By Customer',
                    type: 'bar',
                    stacked: true,
                    data: NoShowByCustomer
                },
                {
                    name: 'No Show By Consultant',
                    type: 'bar',
                    stacked: true,
                    data: NoShowByConsultant
                },
                {
                    name: 'Completed',
                    type: 'bar',
                    stacked: true,
                    data: Completed
                },
                {
                    name: 'Total',
                    type: 'area',
                    stacked: true,
                    data: Total
                }
            ],
            chart: {
                fontFamily: 'inherit',
                stacked: true,
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    stacked: true,
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: ['12%']
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: categories,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                max: response.highest,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return '' + val + ' '
                    }
                }
            },
            colors: ['#009EF7','#F1416C','#50CD89','#7239EA', '#5014D0','#50CD89', baseLightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }
        };

    }

    async function Reload() {
        await requestData();
        chart.updateOptions(chartData);
    }

    async function init() {

        $('#Filteryear').on('select2:select', function (e) {
            const data = e.params.data
            year = data.id
            filtertext.textContent = data.text
            Reload()
        });


        await requestData();
        chart = new ApexCharts(element, chartData);
        // Set timeout to properly get the parent elements width
        setTimeout(function () {
            chart.render();
        }, 200);
    }


    var initChart = function () {
        element = document.getElementById("kt_card_widget_4_chart_consultant");

        if (!element) {
            return;
        }

        height = parseInt(KTUtil.css(element, 'height'));
        labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        lightColor = KTUtil.getCssVariableValue('--bs-success')
        consultant_total = document.getElementById('consultant_total')
        filtertext = document.getElementById('filtertext')
        baseColor = KTUtil.getCssVariableValue('--bs-primary');
        baseLightColor = KTUtil.getCssVariableValue('--bs-light-primary');
        secondaryColor = KTUtil.getCssVariableValue('--bs-info');

        init()

    }

    // Public methods
    return {
        init: function () {
            initChart();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    AppChart.init();
});
