<?php

class Product
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;
    private $quantita;


    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    public function getQuantita()
    {
        return $this->quantita;
    }

    public function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }

}

    //pagina che mostra tutti i prodotti, possiamo aggiungere un oggetto al carrello premendo un pulsante sotto la sua icona
    //form per ogni prodotto, campo hidden per l'id del prodotto
?>