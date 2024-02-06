function AddProduct(name_q, name_p) {
    var p_id = document.getElementById(name_p).value;
    var qty = document.getElementById(name_q).value;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "ok") {
                alert("Operazione avvenuta con successo");
            } else {
                alert("Errore");
            }
        }
    };
    xhttp.open("GET", "../Actions/AddToCartAPI.php?qty=" + qty + "&p_id=" + p_id, true);
    xhttp.send();
}