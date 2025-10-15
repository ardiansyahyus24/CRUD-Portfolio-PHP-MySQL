```php
<?php
require_once __DIR__ . '/../app/functions.php';
$profile = fetch_profile();
$experiences = get_experiences();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Portfolio CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="top">
    <div class="container">
      <h1>Portfolio — <?= htmlspecialchars($profile['name'] ?? 'Nama Kamu') ?></h1>
      <nav>
        <a href="profile_edit.php">Edit Profile</a> |
        <a href="add_experience.php">Add Experience</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="profile card">
      <div class="profile-left">
        <?php if (!empty($profile['photo'])): ?>
          <img src="<?= htmlspecialchars($profile['photo']) ?>" alt="photo" class="avatar">
        <?php else: ?>
          <div class="avatar placeholder">No Photo</div>
        <?php endif; ?>
      </div>
      <div class="profile-right">
        <h2><?= htmlspecialchars($profile['name'] ?? '') ?></h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($profile['email'] ?? '') ?></p>
        <p><?= nl2br(htmlspecialchars($profile['bio'] ?? '')) ?></p>
      </div>
    </section>

    <section class="experiences card">
      <h3>Experiences</h3>
      <?php if (count($experiences) === 0): ?>
        <p>No experiences yet. Add one.</p>
      <?php endif; ?>
      <div class="grid">
        <?php foreach ($experiences as $exp): ?>
          <article class="exp-card">
            <?php if (!empty($exp['image'])): ?>
              <img src="<?= htmlspecialchars($exp['image']) ?>" alt="<?= htmlspecialchars($exp['title']) ?>">
            <?php endif; ?>
            <h4><?= htmlspecialchars($exp['title']) ?></h4>
            <p class="muted"><?= htmlspecialchars($exp['organization']) ?></p>
            <p><?= nl2br(htmlspecialchars($exp['description'])) ?></p>
            <p class="muted"><?= htmlspecialchars($exp['start_date']) ?> — <?= htmlspecialchars($exp['end_date']) ?></p>
            <p>
              <a href="edit_experience.php?id=<?= $exp['id'] ?>">Edit</a> |
              <a href="delete_experience.php?id=<?= $exp['id'] ?>" onclick="return confirm('Delete this experience?')">Delete</a>
            </p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <footer class="container">&copy; <?= date('Y') ?> — Portfolio CRUD</footer>
</body>
</html>
```
