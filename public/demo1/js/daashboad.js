"use strict";

// Class definition
var customer = function () {
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
    var customer_total;
    var filtertext;



    const requestData = async function(){
        const formData = new FormData()
        formData.append('year',year);
        formData.append("_token", csrf);
        await fetch(customer_data,{
            method : 'post',
            body : formData
        })
        .then(response => response.json())
        .then((response) => {
            getChartOpion(response)
        })
    }

    function getChartOpion(data){
        customer_total.textContent = data['total']
        const days = [],val = []
        for (let x in data.chart) { 
            days.push(`${x} ${data.chart[x]['year']}`)
            val.push(data.chart[x]['total'])
        }
        

        chartData =  {
            series: [{
                name: 'Customers',
                data: val
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 80, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: days,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                tickAmount: 6,
                labels: {
                    rotate: 0,
                    rotateAlways: true,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                tickAmount: 4,
                max: data['highest'],
                min: 0,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    },
                    formatter: function (val) {
                        return val
                    }
                }
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
                        return  val+' Customers'
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };
    }

    async function Reload(){
        await requestData();
        chart.updateOptions(chartData);
    }

    async function init(){

        $('#Filteryear').on('select2:select', function (e) {
            const data = e.params.data
            year = data.id
            filtertext.textContent = data.text
            Reload()
        });


        await requestData();
        chart = new ApexCharts(element,chartData);
        // Set timeout to properly get the parent elements width
        setTimeout(function() {
            chart.render();
        }, 200);
    }


    var initChart = function() {
        element = document.getElementById("kt_charts_widget_3");

        if (!element) {
            return;
        }

        height = parseInt(KTUtil.css(element, 'height'));
        labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        baseColor = KTUtil.getCssVariableValue('--bs-success');
        lightColor = KTUtil.getCssVariableValue('--bs-success')
        customer_total = document.getElementById('customer_total')
        filtertext = document.getElementById('filtertext')

        init()

    }

    // Public methods
    return {
        init: function () {
            initChart();
        }
    }
}();

var consultant = function () {
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

    const requestData = async function(){
        const formData = new FormData()
        formData.append('year',year);
        formData.append("_token", csrf);
        await fetch(consultant_data,{
            method : 'post',
            body : formData
        })
        .then(response => response.json())
        .then((response) => {
            getChartOpion(response)
        })
    }

    function getChartOpion(data){
        consultant_total.textContent = data['total']
        const days = [],val = []
        for (let x in data.chart) { 
            days.push(`${x} ${data.chart[x]['year']}`)
            val.push(data.chart[x]['total'])
        }

        chartData =  {
            series: [{
                name: 'Consultant',
                data: val
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 80, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: days,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                tickAmount: 6,
                labels: {
                    rotate: 0,
                    rotateAlways: true,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                tickAmount: 4,
                max: data['highest'],
                min: 0,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    },
                    formatter: function (val) {
                        return val
                    }
                }
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
                        return  val+' Consultant'
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };
    }

    async function Reload(){
        await requestData();
        chart.updateOptions(chartData);
    }

    async function init(){

        $('#Filteryear_consultant').on('select2:select', function (e) {
            const data = e.params.data
            year = data.id
            filtertext.textContent = data.text
            Reload()
        });


        await requestData();
        chart = new ApexCharts(element,chartData);
        // Set timeout to properly get the parent elements width
        setTimeout(function() {
            chart.render();
        }, 200);
    }


    var initChart = function() {
        element = document.getElementById("kt_card_widget_4_chart_consultant");

        if (!element) {
            return;
        }

        height = parseInt(KTUtil.css(element, 'height'));
        labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        baseColor = KTUtil.getCssVariableValue('--bs-success');
        lightColor = KTUtil.getCssVariableValue('--bs-success')
        consultant_total = document.getElementById('consultant_total')
        filtertext = document.getElementById('filtertext_consultant')

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
    customer.init();
    consultant.init();
});
