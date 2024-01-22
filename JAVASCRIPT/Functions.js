function ActionLogin(n) {
    if (n == 0) {
        document.Form_Principale.action = "../Actions/Login.php";
        document.Form_Principale.submit();
    } else if (n == 1) {
        document.Form_Principale.action = "./signup.php";
        document.Form_Principale.submit();
    }
}

function validoSignUp() {
    i = document.getElementById("email").value;
    b = document.getElementById("password").value;
    if (i.indexOf('@') != -1 && i.indexOf('.') != -1 &&
        i.lastIndexOf('.') > i.indexOf('@') && i.length >= 5) {
        if (b.length >= 4) {
            document.Form1.submit();
        } else {
            alert("Password almeno 4 caratteri");
        }
    } else {
        alert("Mail non valida");
    }
}

function ActionCart(n, id) {
    if (n == 0) {
        document.getElementById(id).action = "../Actions/ModifyQTY.php";
        document.getElementById(id).submit();
    } else if (n == 1) {
        document.getElementById(id).action = "../Actions/Delete.php";
        document.getElementById(id).submit();
    }

}

function ActionProduct(n, id) {
    if (n == 0) {
        document.getElementById(id).action = "../Actions/ModifyProduct.php";
        document.getElementById(id).submit();
    } else if (n == 1) {
        document.getElementById(id).action = "../Actions/DeleteProduct.php";
        document.getElementById(id).submit();
    }
    else if (n == 2){
        document.getElementById(id).action = "../Actions/AddProduct.php";
        document.getElementById(id).submit();
    }
}