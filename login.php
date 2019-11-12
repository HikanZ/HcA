<?php
  require "header2.php";
?>

  <main>
    <div class="wrapper-main">
      <section class="section-default">
      </section>
      <h1>Login</h1>
      <form action="includes/login.inc.php" method="post">
        <input type="text" name="mail" placeholder="E-mail">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login2-submit">Signup</button>
      </form>
    </div>
  </main>

<?php
  require "footer.php";
 ?>
