<?php
$c = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
if ($c->connect_error) { die("DB connection failed: " . $c->connect_error); }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])) {
  $s = $c->prepare("INSERT INTO notes(note) VALUES(?)");
  $s->bind_param("s", $_POST['note']);
  $s->execute();
  header("Location: /");
  exit;
}
$r = $c->query("SELECT id, note, created_at FROM notes ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Dania's Notes Board</title></head><body>
<h1>Dania's Notes Board</h1>
<p>FA23-BDS-007 | <?= getenv('PART_LABEL') ?></p>
<form method="post"><input name="note" required> <button>Add note</button></form>
<br>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Note</th><th>Created</th></tr>
<?php while ($row = $r->fetch_assoc()): ?>
<tr><td><?= $row['id'] ?></td><td><?= htmlspecialchars($row['note']) ?></td><td><?= $row['created_at'] ?></td></tr>
<?php endwhile; ?>
</table>
</body></html>
<!-- test -->
<!-- test -->
<!-- x -->
