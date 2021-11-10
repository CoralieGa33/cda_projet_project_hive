<?php

namespace App\api\Entity;
	
class User
{
    private $user_id;
    private $email;
    private $username;
    private $password;
    private $role;
    private $created_at;
    private $updated_at;

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }
    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }
    
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
    * Get the value of username
    */ 
    public function getUsername($username)
    {
        return $this->username;
    }
    /**
    * Set the value of username
    *
    * @return  self
    */ 
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }
    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }
    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($Created_at)
    {
        $this->created_at = $Created_at;
        return $this;
    }

    /**
     * Get the value of Created_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
