<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="../JAVASCRIPT/Functions.js"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>
<h2>Login</h2>
<form method="post" name="Form_Principale" action="">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="button" value="Login" onclick="ActionLogin(0)">
    <input type="button" value="SignUp" onclick="ActionLogin(1)">
</form>
</body>
</html>