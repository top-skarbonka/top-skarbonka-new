<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel firmy - logowanie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            width: 350px;
        }
        .login-box img {
            max-width: 160px;
            margin-bottom: 15px;
        }
        h1 {
            font-size: 22px;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #3490dc;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #2779bd;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" alt="Logo">
        <h1>Panel firmy</h1>
        <form method="POST" action="{{ route('company.login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="Adres e-mail" required>
            <input type="password" name="password" placeholder="Hasło" required>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>
