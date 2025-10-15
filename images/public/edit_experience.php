```php
<?php
require_once __DIR__ . '/../app/functions.php';
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }
$exp = get_experience($id);
$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = update_experience($id, $_POST, $_FILES['image'] ?? null);
    $msg = $ok ? 'Updated.' : 'Failed to update.';
    $exp = get_experience($id);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Experience</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container card">
    <h2>Edit Experience</h2>
    <?php if ($msg): ?><p class="notice"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <label>Title<br><input type="text" name="title" value="<?= htmlspecialchars($exp['title']) ?>"></label>
      <label>Organization<br><input type="text" name="organization" value="<?= htmlspecialchars($exp['organization']) ?>"></label>
      <label>Description<br><textarea name="description"><?= htmlspecialchars($exp['description']) ?></textarea></label>
      <label>Start Date<br><input type="date" name="start_date" value="<?= htmlspecialchars($exp['start_date']) ?>"></label>
      <label>End Date<br><input type="date" name="end_date" value="<?= htmlspecialchars($exp['end_date']) ?>"></label>
      <label>Image (upload to replace)<br><input type="file" name="image" accept="image/*"></label>
      <button type="submit">Save</button>
      <a href="index.php">Back</a>
    </form>
  </div>
</body>
</html>
```
