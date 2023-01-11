"use strict";
var Revenue = function (){

    var chart = null;
    var ctx;
    var primaryColor;
    var dangerColor;
    var successColor;
    var fontFamily;
    var year = ''
    var labels = [];
    var data1 = [];
    var data2 = [];
    var data3 = [];
    var filtertext;
    var Revenue_app
    var Revenue_offer
    var Revenue_total

    function getRandom(min = 1, max = 100) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    function generateRandomData(min = 1, max = 100, count = 10) {
        var arr = [];
        for (var i = 0; i < count; i++) {
            arr.push(getRandom(min, max));
        }
        return arr;
    }


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
        updatechartData(response)
    })
}

const updatechartData = function(response){
    labels = [],data1 = [],data2 = [];data3 = [];
    let app_com = 0,off_com = 0;
    for (let x in response.chart) {
        labels.push(`${x} ${response.chart[x]['year']}`)
        data1.push(parseInt(response.chart[x]['app_com']))
        data2.push(parseInt(response.chart[x]['off_com']))
        data3.push(parseInt(response.chart[x]['total']))
        app_com += response.chart[x]['app_com']
        off_com += response.chart[x]['off_com']
    }
    Revenue_app.innerHTML = currency.currencycode+' '+parseFloat(app_com).toFixed(2);
    Revenue_offer.innerHTML = currency.currencycode+' '+parseFloat(off_com).toFixed(2);
    Revenue_total.innerHTML = currency.currencycode+' '+parseFloat(response.total).toFixed(2);
}
const updatechart = () => {
    chart.data.labels;
    chart.data.datasets.forEach((dataset) => {
        dataset.data.pop()
    })
    chart.data.labels = labels;
    chart.data.datasets[0].data = data1
    chart.data.datasets[1].data = data2
    chart.data.datasets[2].data = data3
    chart.update();
}

async function Reload(){
    await requestData();
    updatechart()
}
async function init(){

    $('#Filteryear').on('select2:select', function (e) {
        const data = e.params.data
        year = data.id
        filtertext.textContent = data.text
        Reload()
    });

    await requestData();
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Appointment',
                data: data1,
                borderColor: primaryColor,
                backgroundColor: 'transparent'
            },
            {
                label: 'Offers',
                data: data2,
                borderColor: dangerColor,
                backgroundColor: 'transparent'
            },
            {
                label: 'Total',
                data:  data3,
                borderColor: successColor,
                backgroundColor: 'transparent'
            },
        ]

    };
    const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                title: {
                    display: false,
                }
            },
            responsive: true,
        }
    };
    chart = new Chart(ctx, config);

}


// Chart data
const data = {
    labels: labels,
    datasets: [
        {
            label: 'Dataset 1',
            data: generateRandomData(1, 50, 7),
            borderColor: primaryColor,
            backgroundColor: 'transparent'
        },
        {
            label: 'Dataset 2',
            data: generateRandomData(1, 50, 7),
            borderColor: dangerColor,
            backgroundColor: 'transparent'
        },
    ]
};

// Chart config



    return{
        init : function(){
            ctx = document.getElementById('kt_chartjs_2');
            primaryColor = KTUtil.getCssVariableValue('--bs-primary');
            dangerColor = KTUtil.getCssVariableValue('--bs-danger');
            successColor = KTUtil.getCssVariableValue('--bs-success');
            fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');
            filtertext = document.getElementById('filtertext')
            Revenue_app = document.getElementById('Revenue_app')
            Revenue_offer = document.getElementById('Revenue_offer')
            Revenue_total = document.getElementById('Revenue_total')

            // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
            init();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    Revenue.init()
});
