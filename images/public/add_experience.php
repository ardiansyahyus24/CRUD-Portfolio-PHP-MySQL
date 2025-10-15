```php
<?php
require_once __DIR__ . '/../app/functions.php';
$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = create_experience($_POST, $_FILES['image'] ?? null);
    $msg = $ok ? 'Experience added.' : 'Failed to add.';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Add Experience</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container card">
    <h2>Add Experience</h2>
    <?php if ($msg): ?><p class="notice"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <label>Title<br><input type="text" name="title"></label>
      <label>Organization<br><input type="text" name="organization"></label>
      <label>Description<br><textarea name="description"></textarea></label>
      <label>Start Date<br><input type="date" name="start_date"></label>
      <label>End Date<br><input type="date" name="end_date"></label>
      <label>Image<br><input type="file" name="image" accept="image/*"></label>
      <button type="submit">Create</button>
      <a href="index.php">Back</a>
    </form>
  </div>
</body>
</html>
```
