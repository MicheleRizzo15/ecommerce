<html>

    <head>
        <title>Unlogged</title>
    </head>

    <body>
    <div>UnLogged</div>

        <?php
        session_start();
        if(isset($_SESSION['user_id'])){
            echo $_SESSION['user_id'];
        }
        else{
            echo "no";
        }
        ?>
    </body>
</html>