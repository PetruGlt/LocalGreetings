<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportIS - Login</title>
    <link rel="stylesheet" href="/LocalGreetings/public/css/loginStyle.css">
</head>
<body>
    <div class="login-container">
        <h1>Bine ai venit! </h1>
        <p>Te rugam sa te conectezi pentru a continua.</p>
        <p class="error-message" style="color: red;" >
            <?php if (isset($errorMessage)) echo htmlspecialchars($errorMessage); ?>
        </p>
        <form action="/LocalGreetings/public/login/authenticate" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Introduceti adresa de email" required>
            </div>
            <div class="input-group">
                <label for="password">Parola</label>
                <input type="password" id="password" name="password" placeholder="Introduceti parola" minlength="6" required>
            </div>
            <div class="button-group">
                <button type="submit">Conectare</button>
            </div>
            <div class="footer">
                <p>Nu ai un cont? <a href="/LocalGreetings/public/login/register">Inregistrare</a></p>
            </div>
        </form>
    </div>
</body>
</html>
