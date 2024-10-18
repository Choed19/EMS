var ctx = document.getElementById('myChart').getContext('2d');

// Create a new Chart instance
var myChart = new Chart(ctx, {
    type: 'bar', // Specify the chart type: 'bar', 'line', 'pie', 'doughnut', etc.
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], // Define the labels for the X axis
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3], // Data points for the chart
            backgroundColor: [ // Colors for each bar
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [ // Border colors for each bar
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1 // Border width for each bar
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true // Ensure the y-axis begins at zero
            }
        }
    }
});


