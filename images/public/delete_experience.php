```php
<?php
require_once __DIR__ . '/../app/functions.php';
$id = $_GET['id'] ?? null;
if ($id) {
    delete_experience($id);
}
header('Location: index.php');
exit;
```
