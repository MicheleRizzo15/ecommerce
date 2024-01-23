<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>

    <script src="../JAVASCRIPT/Functions.js"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/style.css">

</head>
<body>
<h2>Registrazione</h2>
<?php

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $tag= "<input type=\"email\" id=\"email\" name=\"email\" required value=\"$email\">";
} else {
    $email = "email@email.email";
    $tag= "<input type=\"email\" id=\"email\" name=\"email\" required placeholder=\"$email\">";
}

?>
<form method="post" name="Form1" action="../Actions/SignUp.php">

    <label for="email">Email:</label>
    <?php echo $tag;?><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required placeholder="password"><br>


    <input type="button" value="Registrati" onclick="validoSignUp()">
</form>

</body>
</html>