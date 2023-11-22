@extends("Base::backend.master")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Doanh thu tuần</h2>
                        <canvas id="week-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Doanh thu tháng</h2>
                        <canvas id="month-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Doanh thu năm</h2>
                        <canvas id="year-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
	    const week = document.getElementById('week-chart');
	    const month = document.getElementById('month-chart');
	    const year = document.getElementById('year-chart');
	    new Chart(week, {
		    type: 'line',
		    data: {
			    datasets: [{
				    label: '',
				    data: JSON.parse(`{!! $weekData !!}`),
				    borderWidth: 1
			    }]
		    },
		    options: {
			    scales: {
				    y: {
					    beginAtZero: true
				    }
			    }
		    }
	    });

	    new Chart(month, {
		    type: 'line',
		    data: {
			    datasets: [{
				    data: JSON.parse(`{!! $monthData !!}`),
				    borderWidth: 1
			    }]
		    },
		    options: {
			    scales: {
				    y: {
					    beginAtZero: true
				    }
			    }
		    }
	    });

	    new Chart(year, {
		    type: 'line',
		    data: {
			    datasets: [{
				    label: '',
				    data: JSON.parse(`{!! $yearData !!}`),
				    borderWidth: 1
			    }]
		    },
		    options: {
			    scales: {
				    y: {
					    beginAtZero: true
				    }
			    }
		    }
	    });
    </script>
@endpush