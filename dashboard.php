<?php require 'db.php';
if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  log_action($db,$_SESSION['user'],'ATTENDANCE',$_POST['remarks']);   // stored as-is (no validation)
  header('Location: dashboard.php'); exit;
}
$rows=$db->query("SELECT * FROM logs ORDER BY id DESC LIMIT 20")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html><html><head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head><body>
<div class="nav"><b>Attendance System</b><span>Welcome, <?php echo $_SESSION['user']; ?> <a href="logout.php">Logout</a></span></div>
<div class="wrap">
<div class="card"><h2>Log Attendance</h2>
<form method="post">Remarks<input name="remarks" placeholder="e.g. Present, arrived on time"><button>Submit Attendance</button></form></div>
<div class="card"><h2>Who Did It? (Activity Log)</h2>
<table><tr><th>User</th><th>Action</th><th>Remarks</th><th>Time</th></tr>
<?php foreach($rows as $r){ ?>
<tr><td><?php echo $r['username']; ?></td><td><?php echo $r['action']; ?></td><td><?php echo $r['remarks']; ?></td><td><?php echo $r['created_at']; ?></td></tr>
<?php } ?></table></div></div></body></html>
