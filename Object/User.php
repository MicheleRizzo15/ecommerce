<?php       
    class user
    {
        private $id;
        private $email;
        private $password;
        private $role_id;
    
        public function getID()
        {
            return $this->id;
        }
        public function setID($id)
        {
            $this->id = $id;
        }

        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getRole_Id()
        {
            return $this->role_id;
        }
        public function setRole_Id($role_id)
        {
            $this->role_id = $role_id;
        }

    }
?>