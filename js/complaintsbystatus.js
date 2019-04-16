$(document).ready(function(){
    $.ajax({
        //url: "http://localhost/justice-project/admin/complaintsbystatus.php",
        url: "../admin/complaintsbystatus.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var comp_state_desc = [];
            var comp_amt = [];

            for(var i in data) {
                comp_state_desc.push(data[i].complaint_state_desc);
                comp_amt.push(data[i].comp_amt);
            } // for

            var ctx = document.getElementById('myChart3');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: comp_state_desc,
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
                options: {}
            }); // myChart
        },
    });
});