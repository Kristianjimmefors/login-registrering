<?php
session_start();

// Se alla fel under development.
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

class users{
    public $username;
    public $password;

    //skickar in användarnamnent och lösenordet i variablar som man skickar med när man skapar ett nytt objekt 
    function __construct($post){
        $this->username = $post["username"];
        $this->password = $post["password"];
    }
    //registrerar användaren och skapar en fil med användarens namn och lösenord i om användaren inte redan är registrerad
    public function registerUser(){
        //kollar om en fil med användarens namn redan finns så att det inte blir två användare med samma namn
        if (file_exists($this->username . ".csv")) {
            echo "Användarnamnet finns redan! välj ett annat";
        } else{
            //krypterar lösenordet med salt
            $hasedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            //skapar en fil med användarens användarnamn och lösenord och redirectar en till index.php
          $filehandel = fopen($this->username . ".csv", "w+");
          fwrite($filehandel, $this->username . "," . $hasedPassword);
          fclose($filehandel);
          header("Location: index.php");
          exit();
        }
    }
    //loggar in användaren om användarnamnet och lösenordet stämmer annars får man ett felmedelande
    public function loginUser(){
        //gör csv filen med namnet man skickat in till en array
        if ($this->username == file_exists($this->username . ".csv")){
            $csv = array_map("str_getcsv", file($this->username . ".csv"));
            //kollar om lösenordet man skrev in är samma som det man har saltat
            $correctPassword = password_verify($this->password, $csv[0][1]);
            //kollar så att användarnamnet och lösenordet man skrev in stämmer överäns med det som redan fanns och redirectar en till site.php
            if ($correctPassword) {
                $_SESSION["username"] = $this->username;
                header("location: site.php");
                exit();
            }
        } else {
            echo "fel andvändarnamn eller lösenord";
        }
    }
    //loggarut en användare och tar bort sessions datan som finns
    public function logoutUser(){
        session_unset();
        header("Location: index.php");
        exit();
    }
}
