<?php
session_start();

include_once("classUsers.php");

echo "<h1>Registrering</h1>";

//kollar om man har klickat på registrera knappen och skapar ett nytt objekt och kollar om något fält är tomt eller om den kan kalla på register functionen
if (isset($_POST["submit_register"])) {
    $user = new User($_POST);
    if ($_POST["username"] == "" && $_POST["password"] == "") {
        echo "Användarnamnet och lösenordet är tomt!";
    } elseif ($_POST["password"] == "") {
        echo "Lösenordet är tomt!";
    } elseif ($_POST["username"] == "") {
        echo "Användarnamnet är tomt!";
    } else {
        $user->registerUser();
    }
};
?>

<body>
    <form action="register.php" method="POST">
    <label for="username">Användarnamn: </label>
    <input type="text" name="username">
    <br /> <br />
    <label for="password">lösenord: </label>
    <input type="password" name="password"> 
    <input name="submit_register" type="submit" value="Registrera">
    </form>
</body>