```php
<?php
require_once __DIR__ . '/../app/functions.php';
$profile = fetch_profile();
$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = update_profile($_POST, $_FILES['photo'] ?? null);
    $msg = $ok ? 'Profile updated.' : 'Failed to update profile.';
    $profile = fetch_profile();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container card">
    <h2>Edit Profile</h2>
    <?php if ($msg): ?><p class="notice"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <label>Name<br><input type="text" name="name" value="<?= htmlspecialchars($profile['name'] ?? '') ?>"></label>
      <label>Email<br><input type="email" name="email" value="<?= htmlspecialchars($profile['email'] ?? '') ?>"></label>
      <label>Bio<br><textarea name="bio"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea></label>
      <label>Photo<br><input type="file" name="photo" accept="image/*"></label>
      <button type="submit">Save</button>
      <a href="index.php">Back</a>
    </form>
  </div>
</body>
</html>
```
