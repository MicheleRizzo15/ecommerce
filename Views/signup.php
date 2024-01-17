<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <script>
        function valido() {
            i = document.getElementById("email").value;
            b = document.getElementById("password").value;
            if (i.indexOf('@') != -1 && i.indexOf('.') != -1 &&
            i.lastIndexOf('.') > i.indexOf('@') && i.length >= 5)
            {
                if(b.length>=4){
                    document.Form1.submit();
                }
                else{
                    alert("Password almeno 4 caratteri");
                }
            }
            else{
                alert("Mail non valida");
            }
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
            text-align: left;
            margin-left: -10px;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="email"],
        input[type="password"],
        input[type="button"] {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Registrazione</h2>
<form method="post" name="Form1" action="../Actions/SignUp.php">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="button" value="Registrati" onclick="valido()">
</form>
</body>
</html>