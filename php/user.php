<?php
require_once 'info.php';

class User
{

    private $id, $first_name, $last_name, $email, $pass;

    public $wmsg = 0;

    // gets info of user with email or phone and password
    function getUser($user, $pass)
    {
        $this->wmsg = 0;
        $user = sanitizeString($user);
        $pass = sanitizeString($pass);
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $user))
            $result = queryMysql("SELECT * FROM members WHERE email='$user' AND pass='$pass'");
        else {
            $this->wmsg = 3; // Invalid phone or email error
            return;
        }
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->pass = $row['pass'];
        } else {
            $this->wmsg = 2; // User not exist error
        }
    }

    // create user
    function createUser($user, $pass, $first_name, $last_name)
    {
        $this->wmsg = 0;
        $user = sanitizeString($user);
        $pass = sanitizeString($pass);
        $first_name = sanitizeString($first_name);
        $last_name = sanitizeString($last_name);
        if (! preg_match("/^[a-zA-Z\\s]*$/", $first_name . $last_name)) {
            $this->wmsg = 5; // invalid name
            return;
        }
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $user))
            $email = $user;
        else {
            $this->wmsg = 4; // invalid email or phone
            return;
        }
        $query = queryMysql("SELECT * FROM members where email = '$email'");
        if (! $query->num_rows) {
            queryMysql("INSERT INTO members VALUES(NULL, '$first_name', '$last_name', '$email', '$pass')");
            $this->getUser($user, $pass);
        } else
            $this->wmsg = 1; // User already exist error
    }

    // display all data
    function showUser()
    {
        if (isset($this->email))
            echo "$this->first_name, $this->last_name, $this->email, $this->pass";
        else
            echo "Nothing to display";
    }

    function getName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    function getFirstName()
    {
        return $this->first_name;
    }

    function getLastName()
    {
        return $this->last_name;
    }

    function getPassword()
    {
        return $this->pass;
    }

    function getEmail()
    {
        return $this->email;
    }

    function showError()
    {
        if ($this->wmsg == 0)
            return "No error";
        else if ($this->wmsg == 1)
            return "User Already Exist Try to Login or Reset your password";
        else if ($this->wmsg == 2)
            return "Invalid Credentials Try Again!";
        else if ($this->wmsg == 3)
            return "Invalid Email or Phone No Try Again!";
        else if ($this->wmsg == 4)
            return "Invalid Email or Phone No Try Again!";
        else if ($this->wmsg == 5)
            return "Invalid Name Try Again!";
        else if ($this->wmsg == 7)
            return "Lesser Birthday Not Eligible to Signup";
        else if ($this->wmsg == 8)
            return "Friend Request not sent by the user";
        else if ($this->wmsg == 9)
            return "User not exist to send request";
        else if ($this->wmsg == 10)
            return "Friend request already sent by the user you have to accept";
        else if ($this->wmsg == 11)
            return "You both are friends";
        else if ($this->wmsg == 12)
            return "Friend request already sent";
        else if ($this->wmsg == 13)
            return "No friends to show";
        else if ($this->wmsg == 14)
            return "No friends Request to show";
        else if ($this->wmsg == 15)
            return "No friends Request sent";
        else if ($this->wmsg == 16)
            return "No Groups for you";
        return null;
    }

    function getMyId()
    {
        return $this->id;
    }
}
?>


