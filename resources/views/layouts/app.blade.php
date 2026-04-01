<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Koding Next Samarinda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            pink: '#E4559B',
                            'light-pink': '#FCEEF5',
                            blue: '#51A7D3',
                            'light-blue': '#E5F2F8',
                        }
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-white text-gray-800 font-sans">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        @include('partials.navbar')

        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
        
    </div>

</body>
</html>