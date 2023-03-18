

/*
|--------------------------------------------------------------------------
| Document ready
|--------------------------------------------------------------------------
*/
$( document ).ready(function() {
    pieChart();
    lineChart();
});


function pieChart(){

    const data = {
        labels: [
          'Red',
          'Blue',
          'Yellow'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [300, 50, 100],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('pieChart'),
        config
    );

}


function lineChart(){


    const labels = ['jan', 'feb', 'jan','jan','jan','jan','jan'];
    const data = {
    labels: labels,
    datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
    };

    const config = {
        type: 'line',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('lineChart'),
        config
    );
}
