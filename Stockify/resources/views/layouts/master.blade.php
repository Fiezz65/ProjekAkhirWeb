<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Stockify')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F7F8FC;
            color: #2D3748;
        }
        .ui-card {
            background-color: #FFFFFF;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .ui-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .ui-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .ui-button-primary {
            background-color: #4A55F7;
            color: white;
            box-shadow: 0 4px 6px rgba(74, 85, 247, 0.2);
        }
        .ui-button-primary:hover {
            background-color: #3A43D9;
            transform: translateY(-2px);
            box-shadow: 0 7px 10px rgba(74, 85, 247, 0.25);
        }
        .ui-button-secondary {
            background-color: #E2E8F0;
            color: #4A5568;
        }
        .ui-button-secondary:hover {
            background-color: #CBD5E0;
        }
        .ui-button-outline {
            background-color: transparent;
            color: #4A5568;
            border: 1px solid #E2E8F0;
            font-weight: 600;
        }
        .ui-button-outline:hover {
            background-color: #F7F8FC;
            color: #4A55F7;
            border-color: #C3DAFE;
        }
        .ui-input {
            width: 100%;
            background-color: #F7F8FC;
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }
        .ui-input:focus {
            outline: none;
            border-color: #4A55F7;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(74, 85, 247, 0.2);
        }
        .sidebar-link.active {
            background-color: #4A55F7;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body class="text-slate-800 @yield('body-class')">

    <div class="flex min-h-screen">
        @if(Auth::check())
            @include('layouts.sidebar')
        @endif
        <div class="flex-1">
            <main class="p-4 sm:p-6 md:p-8">
                @yield('konten')
            </main>
        </div>
    </div>
    <script>
      feather.replace();
    </script>
</body>
</html>
