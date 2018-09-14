<?php 
session_start();

include_once("classUsers.php");

echo "<h1>Välkommen</h1>";
echo "<p>Du är inloggad som: " . $_SESSION["username"] . "</p>";

//kollar om man klickar på logga ut knappen och kallar på loggut functionen
if (isset($_POST["submit_logout"])) {
    $user = new users($_POST);
    $user->logoutUser();
};
?>
<form action="site.php" method="POST">
    <input name="submit_logout" type="submit" value="Logga ut">
</form>