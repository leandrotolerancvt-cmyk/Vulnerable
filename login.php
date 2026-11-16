<?php require 'db.php'; $msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $s=$db->prepare("SELECT * FROM users WHERE username=?"); $s->execute([$_POST['username']]); $u=$s->fetch(PDO::FETCH_ASSOC);
  if($u && password_verify($_POST['password'],$u['password'])){
    $_SESSION['user']=$u['username']; log_action($db,$u['username'],'LOGIN'); header('Location: dashboard.php'); exit;
  } else $msg='Invalid username or password.';
}?>
<!DOCTYPE html><html><head><title>Login</title><link rel="stylesheet" href="style.css"></head><body>
<div class="nav"><b>Attendance System</b><span><a href="register.php">Register</a></span></div>
<div class="wrap"><div class="card"><h2>Login</h2>
<?php if(isset($_GET['registered'])) echo "<div class='ok'>Registered! Please log in.</div>"; if($msg) echo "<div class='err'>$msg</div>"; ?>
<form method="post">Username<input name="username" required>Password<input type="password" name="password" required>
<button>Login</button></form></div></div></body></html>
