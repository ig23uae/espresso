<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login Page</title>
</head>
<body class="bg-gray-700 text-sans overflow-hidden">
<div class="flex h-screen justify-center items-center">
    <div class="bg-gray-500 text-black p-8 rounded-lg shadow-lg flex flex-col items-center">
        <form method="POST" action="auth_handler">
            @csrf
            <div class="mb-4">
                <label for="password-input">
                    Пароль:
                </label>
                <input name="password" type="text" id="password-input" placeholder="Enter your password" class="text-center form-input px-4 py-2 max-w-56 rounded" autocomplete="off">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('1')" type="button">1</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('2')" type="button">2</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('3')" type="button">3</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('4')" type="button">4</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('5')" type="button">5</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('6')" type="button">6</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('7')" type="button">7</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('8')" type="button">8</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('9')" type="button">9</button>
                <button class="p-4 bg-blue-500 rounded text-black  hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300" onclick="clearInput()" type="button">clear</button>
                <button class="p-4 bg-gray-300 rounded text-black" onclick="enterDigit('0')" type="button">0</button>
                <button class="p-4 bg-green-500 rounded text-black hover:bg-green-600 focus:ring-4 focus:outline-none focus:green-blue-300" type="submit">submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('password-input').addEventListener('mouseenter', function(event) {
        event.target.setAttribute('autocomplete', 'off')
    });
    function enterDigit(digit) {
        const input = document.getElementById('password-input');
        input.value += digit;
    }
    function clearInput(){
        document.getElementById('password-input').value = '';
    }
</script>
</body>
</html>
