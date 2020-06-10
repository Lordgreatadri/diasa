// remove the preloader when the page fully loads
$(window).load(function() {
    $(".pre-loader").fadeOut(500);
});

// define chart colors
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

function drawBarChart(ctx, data, labels, title) {
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: labels,
	        datasets: [{
	        	label: title,
	            data: data, 
	            backgroundColor: [
	                window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.grey,
					window.chartColors.green,
					window.chartColors.orange,
					window.chartColors.purple,
					window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.grey,
					window.chartColors.green,
					window.chartColors.orange,
					window.chartColors.purple,
					window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.grey,
					window.chartColors.green,
					window.chartColors.orange,
					window.chartColors.purple,
	            ],
	            borderColor: [
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0'
	            ],
	            borderWidth: 2
	        }]
	    },
	    options: {
	    	responsive: true,
			title: {
				display: true,
				text: ''
			},
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
}

function drawPieChart(ctx, data, labels) {
	var myChart = new Chart(ctx, {
	    type: 'pie',
		data: {
			datasets: [{
				data: data,
				backgroundColor: [
					window.chartColors.purple,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.grey,
					window.chartColors.green,
					window.chartColors.orange,
					window.chartColors.purple,
				],
				label: 'Highest Voters'
			}],
			labels: labels
		},
		options: {
			responsive: true
		}
	});
}

function showSuccessMessage(message, title){
    toastr.success(message, title,{
        "positionClass": "toast-top-center",
        timeOut: 5000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false

    })
}

function showWarningMessage(message, title){
    toastr.warning(message, title,{
        "positionClass": "toast-top-center",
        timeOut: 5000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false

    })
}

function showErrorMessage(message, title){
    toastr.error(message, title,{
        "positionClass": "toast-top-center",
        timeOut: 5000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false

    })
}