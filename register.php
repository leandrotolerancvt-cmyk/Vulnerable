<?php require 'db.php'; $msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $u=$_POST['username']; $p=$_POST['password'];
  try{
    $s=$db->prepare("INSERT INTO users(username,password) VALUES(?,?)");
    $s->execute([$u,password_hash($p,PASSWORD_DEFAULT)]);
    header('Location: login.php?registered=1'); exit;
  }catch(Exception $e){ $msg='Username already taken.'; }
}?>
<!DOCTYPE html><html><head><title>Register</title><link rel="stylesheet" href="style.css"></head><body>
<div class="nav"><b>Attendance System</b><span><a href="login.php">Login</a></span></div>
<div class="wrap"><div class="card"><h2>Register</h2>
<?php if($msg) echo "<div class='err'>$msg</div>"; ?>
<form method="post">Username<input name="username" required>Password<input type="password" name="password" required>
<button>Register</button></form></div></div></body></html>
