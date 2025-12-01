<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barangay Health Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS for basic styling -->
    <style>
        body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f9f9f9; }
        .navbar { display:flex; justify-content:space-between; align-items:center; padding:10px 20px; background:#4CAF50; color:white; flex-wrap:wrap; }
        .navbar a { color:white; margin-left:10px; text-decoration:none; font-weight:bold; }
        .navbar .brand { font-size:1.2rem; font-weight:bold; }
        .navbar .nav-links { display:flex; align-items:center; flex-wrap:wrap; }
        .navbar button { background:none; border:none; color:white; cursor:pointer; font-weight:bold; margin-left:10px; }

        .container { padding:20px; text-align:center; }
        .stats-box { display:inline-block; width:150px; margin:10px; padding:10px; background:#fff; text-align:center; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1); }
        .chart-container { width:300px; margin:20px auto; }
        #appointmentButton { padding:10px 20px; background:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer; font-size:1rem; margin-top:20px; }
        @media(max-width:768px){ .chart-container{ width:90%; } }
    </style>

    <!-- Chart.js & Axios -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="brand">Barangay Health System</div>
        <div class="nav-links">
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @else
                <span>Welcome, {{ Auth::user()->name }}</span>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endguest
        </div>
    </div>

    <div class="container">
        <h1>Barangay Health Dashboard</h1>

        <!-- STAT BOXES -->
        <div>
            <div class="stats-box">Total Residents: <span id="totalResidents">0</span></div>
            <div class="stats-box">Healthy: <span id="healthy">0</span></div>
            <div class="stats-box">Sick: <span id="sick">0</span></div>
            <div class="stats-box">Pregnant Women: <span id="pregnantWomen">0</span></div>
            <div class="stats-box">Male: <span id="male">0</span></div>
            <div class="stats-box">Female: <span id="female">0</span></div>
            <div class="stats-box">Children: <span id="children">0</span></div>
        </div>

        <!-- CHARTS -->
        <div class="chart-container">
            <canvas id="genderChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="healthChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="pregnantChart"></canvas>
        </div>

        <!-- APPOINTMENT BUTTON -->
        <div>
            <a href="{{ route('appointments.create') }}"><button id="appointmentButton">Make Appointment</button></a>
        </div>
    </div>

    <!-- FETCH DATA AND RENDER CHARTS -->
    <script>
        axios.get("{{ url('/api/dashboard-stats') }}")
        .then(function(response){
            const data = response.data;

            // GENDER PIE CHART
            new Chart(document.getElementById('genderChart').getContext('2d'), {
                type:'pie',
                data:{
                    labels:['Male','Female','Children'],
                    datasets:[{
                        data:[data.male,data.female,data.children],
                        backgroundColor:['#36A2EB','#FF6384','#FFCE56']
                    }]
                }
            });

            // HEALTH BAR CHART
            new Chart(document.getElementById('healthChart').getContext('2d'), {
                type:'bar',
                data:{
                    labels:['Healthy','Sick'],
                    datasets:[{
                        label:'Health Status',
                        data:[data.healthy,data.sick],
                        backgroundColor:['#4CAF50','#F44336']
                    }]
                },
                options:{ scales:{ y:{ beginAtZero:true } } }
            });

            // PREGNANT DOUGHNUT CHART
            new Chart(document.getElementById('pregnantChart').getContext('2d'), {
                type:'doughnut',
                data:{
                    labels:['Pregnant Women','Others'],
                    datasets:[{
                        data:[data.pregnantWomen, data.totalResidents - data.pregnantWomen],
                        backgroundColor:['#FF9F40','#36A2EB']
                    }]
                }
            });

            // UPDATE STAT BOXES
            document.getElementById('totalResidents').innerText = data.totalResidents;
            document.getElementById('healthy').innerText = data.healthy;
            document.getElementById('sick').innerText = data.sick;
            document.getElementById('pregnantWomen').innerText = data.pregnantWomen;
            document.getElementById('male').innerText = data.male;
            document.getElementById('female').innerText = data.female;
            document.getElementById('children').innerText = data.children;

        }).catch(function(error){
            console.error(error);
        });
    </script>

</body>
</html>
