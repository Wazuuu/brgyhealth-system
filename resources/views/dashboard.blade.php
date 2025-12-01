<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Barangay Health System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js & Axios -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-green-600 text-white flex-shrink-0">
            <div class="p-6 text-2xl font-bold text-center border-b border-green-500">
                Barangay Health
            </div>
            <nav class="mt-6">
                <a href="{{ route('home') }}" class="block py-2 px-6 hover:bg-green-700">Dashboard</a>
                <a href="{{ route('appointments.index') }}" class="block py-2 px-6 hover:bg-green-700">Appointments</a>
                <a href="{{ route('profile.edit') }}" class="block py-2 px-6 hover:bg-green-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-6 hover:bg-green-700">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-gray-700">Dashboard</h1>

            <!-- Stat Boxes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Total Residents</div>
                    <div class="text-2xl font-bold" id="totalResidents">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Healthy</div>
                    <div class="text-2xl font-bold" id="healthy">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Sick</div>
                    <div class="text-2xl font-bold" id="sick">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Pregnant Women</div>
                    <div class="text-2xl font-bold" id="pregnantWomen">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Male</div>
                    <div class="text-2xl font-bold" id="male">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Female</div>
                    <div class="text-2xl font-bold" id="female">0</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-gray-500">Children</div>
                    <div class="text-2xl font-bold" id="children">0</div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-bold mb-2">Gender Distribution</h2>
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-bold mb-2">Health Status</h2>
                    <canvas id="healthChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-bold mb-2">Pregnancy Status</h2>
                    <canvas id="pregnantChart"></canvas>
                </div>
            </div>

            <!-- Appointment Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('appointments.create') }}">
                    <button class="bg-green-600 text-white px-6 py-3 rounded shadow hover:bg-green-700">
                        Make Appointment
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Script to fetch data and render charts -->
    <script>
        axios.get("{{ url('/api/dashboard-stats') }}")
        .then(function(response){
            const data = response.data;

            // Update Stat Boxes
            document.getElementById('totalResidents').innerText = data.totalResidents;
            document.getElementById('healthy').innerText = data.healthy;
            document.getElementById('sick').innerText = data.sick;
            document.getElementById('pregnantWomen').innerText = data.pregnantWomen;
            document.getElementById('male').innerText = data.male;
            document.getElementById('female').innerText = data.female;
            document.getElementById('children').innerText = data.children;

            // Gender Chart
            new Chart(document.getElementById('genderChart').getContext('2d'), {
                type:'pie',
                data:{
                    labels:['Male','Female','Children'],
                    datasets:[{ data:[data.male,data.female,data.children], backgroundColor:['#36A2EB','#FF6384','#FFCE56'] }]
                }
            });

            // Health Chart
            new Chart(document.getElementById('healthChart').getContext('2d'), {
                type:'bar',
                data:{ labels:['Healthy','Sick'], datasets:[{ label:'Health Status', data:[data.healthy,data.sick], backgroundColor:['#4CAF50','#F44336'] }] },
                options:{ scales:{ y:{ beginAtZero:true } } }
            });

            // Pregnant Chart
            new Chart(document.getElementById('pregnantChart').getContext('2d'), {
                type:'doughnut',
                data:{ labels:['Pregnant Women','Others'], datasets:[{ data:[data.pregnantWomen, data.totalResidents-data.pregnantWomen], backgroundColor:['#FF9F40','#36A2EB'] }] }
            });

        }).catch(function(error){ console.error(error); });
    </script>

</body>
</html>
