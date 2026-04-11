<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') - Koding Next Samarinda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                            'light-pink-hover': '#FBE6F0',
                            'light-pink-active': '#F7CAE0',
                            'pink-hover': '#CD4D8C',
                            'pink-active': '#B6447C',
                            blue: '#51A7D3',
                            'light-blue': '#EEF6FB',
                            'light-blue-hover': '#E5F2F8',
                            'light-blue-active': '#C9E4F1',
                            'blue-hover': '#4996BE',
                            'blue-active': '#4186A9',
                        }
                    }
                }
            }
        }
    </script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-brand-pink/50 via-white to-brand-blue/50 p-6 relative">

    @yield('content')

    <div class="absolute bottom-6 left-0 right-0 text-center w-full z-0">
        <p class="text-xs font-medium text-gray-700">© 2026 Koding Next. All rights reserved.</p>
    </div>

</body>
</html>