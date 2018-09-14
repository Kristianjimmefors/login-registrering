<?php
session_start();

include_once("classUsers.php");

echo "<h1>Logga in</h1>";
//kollar om man har klickat på login knappen och skapar ett nytt objekt och kolalr om något fält är tomt eller om den kan kalla på login functionen
if (isset($_POST["submit"])) {
    $user = new users($_POST);
    if ($_POST["username"] == "" && $_POST["password"] == "") {
        echo "Användarnamnet och lösenordet är tomt!";
    } elseif ($_POST["password"] == "") {
        echo "Lösenordet är tomt!";
    } elseif ($_POST["username"] == "") {
        echo "Användarnamnet är tomt!";
    } else {
        $user->loginUser();
    }
};
?>        
<body>
    <form action="index.php" method="POST">
    <label for="username">Användarnamn: </label>
    <input type="text" name="username">
    <br /> <br />
    <label for="password">lösenord: </label>
    <input type="password" name="password">
    <input name="submit" type="submit" value="Logga in">
    </form>
    <p>Inget konto? registrera <a href="register.php">Här</H1></a></p>
</body>