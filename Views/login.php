<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        function Action(n) {
            if (n == 0) {
                document.Form_Principale.action = "../Actions/Login.php";
                document.Form_Principale.submit();
            } else if (n == 1) {
                window.location = "./signup.php";
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

        input[type="button"]:last-of-type {
            margin-top: 10px;
        }

    </style>
</head>
<body>
<h2>Login</h2>
<form method="post" name="Form_Principale" action="">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="button" value="Login" onclick="Action(0)">
</form>
 <input type="button" value="SignUp" onclick="Action(1)">
</body>
</html>
