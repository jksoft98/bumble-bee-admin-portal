

/*
|--------------------------------------------------------------------------
| Document ready
|--------------------------------------------------------------------------
*/
$( document ).ready(function() {
    lineChartMonthly(sales_chart_data.monthly);
    lineChartWeekly(sales_chart_data.weekly);
    lineChartDaily(sales_chart_data.daily);
    pieChartLastThirtyDays(sales_item_chart_data.last_thirty_days);
    pieChartLastTwowellMonths(sales_item_chart_data.last_twowell_months);
});


function pieChartLastThirtyDays(chart_data){

    const data = {
        labels: chart_data.map(item => item.product),
        datasets: [{
          //label: 'My First Dataset',
          data: chart_data.map(item => item.sales_qty),
          backgroundColor: chart_data.map(item => item.color),
          hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('pieChartLastThirtyDays'),
        config
    );

}


function pieChartLastTwowellMonths(chart_data){

    const data = {
        labels: chart_data.map(item => item.product),
        datasets: [{
          //label: 'My First Dataset',
          data: chart_data.map(item => item.sales_qty),
          backgroundColor: chart_data.map(item => item.color),
          hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('pieChartLastTwowellMonths'),
        config
    );
}


function lineChartMonthly(chart_data){


    const labels = chart_data.map(item => item.month);
    const data = {
    labels: labels,
    datasets: [
        {
            label: 'Sales',
            data: chart_data.map(item => item.grand_total),
            fill: false,
            borderColor: 'rgb(229, 152, 102)',
            tension: 0.1
        },
        {
            label: 'Orders',
            data: chart_data.map(item => item.orders),
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }
    ]
    };

    const config = {
        type: 'line',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('lineChartMonthly'),
        config
    );
}



function lineChartWeekly(chart_data){


    const labels = chart_data.map(item => item.week);
    const data = {
    labels: labels,
    datasets: [
        {
            label: 'Sales',
            data: chart_data.map(item => item.grand_total),
            fill: false,
            borderColor: 'rgb(229, 152, 102)',
            tension: 0.1
        },
        {
            label: 'Orders',
            data: chart_data.map(item => item.orders),
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }
    ]
    };

    const config = {
        type: 'line',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('lineChartWeekly'),
        config
    );
}


function lineChartDaily(chart_data){


    const labels = chart_data.map(item => item.date);
    const data = {
    labels: labels,
    datasets: [
        {
            label: 'Sales',
            data: chart_data.map(item => item.grand_total),
            fill: false,
            borderColor: 'rgb(229, 152, 102)',
            tension: 0.1
        },
        {
            label: 'Orders',
            data: chart_data.map(item => item.orders),
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }
    ]
    };

    const config = {
        type: 'line',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('lineChartDaily'),
        config
    );
}
