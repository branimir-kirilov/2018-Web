<?php
namespace models;
use libs\Db;
class User implements \JsonSerializable
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $full_name;
    
    public function __construct() {

    }

    public static function create($username, $password, $email, $full_name)
    {
        $instance = new self();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $instance->setUsername($username);
        $instance->setPassword($hashed_password);
		$instance->setEmail($email);
        $instance->setFullName($full_name);      
        
        return $instance;
    }

    public function setId($id)
    {    
        $this->id = $id;
    }

    public function getId()
    {    
        return $this->id;
    }

    public function setUsername($username)
    {    
        $this->username = $username;
    }

    public function getUsername()
    {    
        return $this->username;
    }

    public function setPassword($password)
    {    
        $this->password = $password;
    }

    public function getPassword()
    {    
        return $this->password;
    }

    public function setEmail($email)
    {    
        $this->email = $email;
    }

    public function getEmail()
    {    
        return $this->email;
    }

    public function setFullName($full_name)
    {    
		$this->full_name = $full_name;
    }

    public function getFullName()
    {    
		return $this->full_name;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `users` (username, password, email, full_name) VALUES (?, ?, ?, ?) ");
        return $query->execute([$this->username, $this->password, $this->email, $this->full_name]);
    }

    public function getUser($username, $password)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username = '$username'");
        $query->execute();

        while ($foundUser = $query->fetch())
        {
            if(password_verify($password, foundUser['password'])) {
                $user = new User();

                $user->setUsername($foundUser['username']);
                $user->setId($foundUser['id']);
            }
            else {
                return false;
            }
            
        }
        
        return $user;
    }

    public function getUserByUsername($username)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username = '$username'");
        $query->execute();
        
        $user = new User();

        while ($found_user = $query->fetch())
        {
            $user->setUsername($found_user['username']);
            $user->setFullName($found_user['full_name']);
            $user->setId($found_user['id']);
        }

        return $user;
    }

    public function getUsersByUsernamePattern($username_pattern) {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username LIKE '$username_pattern%'");
        $query->execute();
        
        $found_users = array();

        while ($found_user = $query->fetch())
        {
            $user = new User();
            $user->setUsername($found_user['username']);
            $user->setId($found_user['id']);
            array_push($found_users, $user);
        }

        return $found_users;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
  }
?>