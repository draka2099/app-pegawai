<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 text-gray-800">
<nav x-data="{ open: false }" class="bg-gray-800 shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div>
                <a class="text-white text-2xl font-bold" href="{{ url('/') }}">App Pegawai</a>
            </div>
            
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('employees.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Employee</a>
                <a href="{{ route('departments.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Department</a>
                <a href="{{ route('positions.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Position</a>
                
                <a href="{{ route('attendances.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Attendance</a>
                <a href="{{ route('salaries.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Salary</a>
                <a href="{{ route('salaries.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Settings</a>
                <a href="{{ route('salaries.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Report</a>
            </div>

            <div class="md:hidden">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': !open}" class="md:hidden mt-2">
            <a href="{{ route('employees.index') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 rounded">Employee</a>
            <a href="{{ route('departments.index') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 rounded">Department</a>
            <a href="{{ route('positions.index') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 rounded">Position</a>
            <a href="{{ route('attendances.index') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 rounded">Attendance</a>
            <a href="{{ route('salaries.index') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 rounded">Salary</a>
        </div>
    </div>
</nav>
<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>
<footer class="text-center py-6 text-gray-500 text-sm">
    &copy; {{ date('Y') }} App Pegawai
</footer>
</body>
</html>