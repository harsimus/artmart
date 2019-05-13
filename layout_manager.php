
<?php
  function loginform() {
    echo "<form action='/artmart/validatelogin.php' method='POST'>
          <p><b>Username:</b></p>
          <input type='text' id='usernameinput' name='usernameinput' />
          <p><b>Password:</b></p>
          <input type='password' id='passwordinput' name='passwordinput' />
          <input type='submit' value='Login' />
          <button type='button' onclick='location.href=\"/xampp/breaddit/register.html\";'>Register</button>
        </form>";
  }
  function logout() {
    echo nl2br("<p>welcome <b>".$_SESSION['username']."</b></p><form action='/artmart/logout.php' method='GET'>&nbsp;&nbsp;<input type='submit' value='Logout' /></form>");
  }
?>
