<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vigenere Cipher Breaker</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="mx-auto bg-gray-100">
    <header class="flex items-center justify-center flex-col pt-4 pb-4 bg-purple-900 border-b-8 border-yellow-600" style="min-height: 5rem;">
        <h1 class="text-2xl lg:text-4xl mt-2 text-gray-300" style="font-family: ProximaBold">Vigenere Cipher Breaker</h1>
        <span class="text-gray-400 text-sm">A mini project by Tosin Soremekun & Faisal Sumaila</span>
    </header>

    <div id="app">
        <vigenere></vigenere>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>