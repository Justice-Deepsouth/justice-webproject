$(document).ready(function(){
    $.ajax({
        //url: "http://localhost/justice-project/admin/complaintsbymonth.php",
        url: "../admin/complaintsbymonth.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var comp_month_year = [];
            var comp_amt = [];

            for(var i in data) {
                comp_month_year.push(data[i].comp_month_year);
                comp_amt.push(data[i].comp_amt);
            } // for

            var ctx = document.getElementById('myChart1');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: comp_month_year,
                    datasets: [{
                        label: 'จำนวนข้อร้องเรียน',
                        data: comp_amt,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }] // datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }] // yAxes
                    } // scales
                } // options
            }); // myChart
        },
    });
});