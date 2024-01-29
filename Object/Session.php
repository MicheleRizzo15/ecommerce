<?php

class Session
{
    private $id;
    private $ip;
    private $data_login;
    private $disabilited;

    public function getId()
    {
        return $this->id;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getDataLogin()
    {
        return $this->data_login;
    }

    public function setDataLogin($data_login)
    {
        $this->data_login = $data_login;
    }

    public function getDisabilited()
    {
        return $this->disabilited;
    }

    public function setDisabilited($disabilited)
    {
        $this->disabilited = $disabilited;
    }
}
?>