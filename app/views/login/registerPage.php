<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportIS - Registration</title>
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/loginStyle.css">
</head>
<body>
    <div class="login-container">
        <h1>Inregistreaza-te!</h1>
        <p>Te rugam sa te inregistrezi pentru a crea un cont.</p>
        <p class="error-message" style="color: red;">
            <?php if (isset($errorMessage)) echo htmlspecialchars($errorMessage); ?>
        </p>
        <form action="<?php echo Config::get("APP_URL"); ?>/login/createAccount" method="POST">
            <div class="input-group">
                <label for="username">Nume de utilizator</label>
                <input type="text" id="username" name="username" placeholder="Introduceti numele de utilizator dorit" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Introduceti adresa de email" required>
            </div>
            <div class="input-group">
                <label for="password">Parola</label>
                <input type="password" id="password" name="password" placeholder="Introduceti parola" minlength="6" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirma Parola</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma parola" minlength="6" required>
            </div>
            <div class="button-group">
                <button type="submit">Inregistrare</button>
            </div>
            <div class="footer">
                <p>Ai deja un cont? <a href="<?php echo Config::get("APP_URL"); ?>/login/index">Conectare</a></p>
            </div>
        </form>
    </div>
</body>
</html>
