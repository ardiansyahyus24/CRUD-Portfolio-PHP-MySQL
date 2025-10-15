```php
<?php
// app/functions.php
require_once __DIR__ . '/config.php';

function fetch_profile() {
    global $mysqli;
    $res = $mysqli->query("SELECT * FROM profile ORDER BY id LIMIT 1");
    return $res->fetch_assoc();
}

function update_profile($data, $file=null) {
    global $mysqli;
    $name = $mysqli->real_escape_string($data['name']);
    $email = $mysqli->real_escape_string($data['email']);
    $bio = $mysqli->real_escape_string($data['bio']);

    $photo_path = null;
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $photo_path = upload_file($file);
    }

    // check existing
    $row = $mysqli->query("SELECT id FROM profile LIMIT 1")->fetch_assoc();
    if ($row) {
        $sql = "UPDATE profile SET name='$name', email='$email', bio='$bio'";
        if ($photo_path) $sql .= ", photo='".$mysqli->real_escape_string($photo_path)."'";
        $sql .= " WHERE id=".$row['id'];
        return $mysqli->query($sql);
    } else {
        $sql = "INSERT INTO profile (name,email,bio,photo) VALUES ('{$name}','{$email}','{$bio}'";
        $sql .= $photo_path ? ", '{$mysqli->real_escape_string($photo_path)}')" : ")";
        return $mysqli->query($sql);
    }
}

function upload_file($file) {
    $uploads_dir = __DIR__ . '/../public/uploads';
    if (!is_dir($uploads_dir)) mkdir($uploads_dir, 0755, true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safe = uniqid() . '.' . $ext;
    $target = $uploads_dir . '/' . $safe;
    if (move_uploaded_file($file['tmp_name'], $target)) {
        // return relative path used by web
        return 'uploads/' . $safe;
    }
    return null;
}

// Experiences
function get_experiences() {
    global $mysqli;
    $res = $mysqli->query("SELECT * FROM experiences ORDER BY created_at DESC");
    return $res->fetch_all(MYSQLI_ASSOC);
}

function get_experience($id) {
    global $mysqli;
    $id = (int)$id;
    $res = $mysqli->query("SELECT * FROM experiences WHERE id=$id LIMIT 1");
    return $res->fetch_assoc();
}

function create_experience($data, $file=null) {
    global $mysqli;
    $title = $mysqli->real_escape_string($data['title']);
    $org = $mysqli->real_escape_string($data['organization']);
    $desc = $mysqli->real_escape_string($data['description']);
    $start = $mysqli->real_escape_string($data['start_date']);
    $end = $mysqli->real_escape_string($data['end_date']);
    $image = null;
    if ($file && $file['error'] === UPLOAD_ERR_OK) $image = upload_file($file);
    $sql = "INSERT INTO experiences (title,organization,description,start_date,end_date,image) VALUES ('{$title}','{$org}','{$desc}','{$start}','{$end}','".($image?$mysqli->real_escape_string($image):'')."')";
    return $mysqli->query($sql);
}

function update_experience($id, $data, $file=null) {
    global $mysqli;
    $id = (int)$id;
    $title = $mysqli->real_escape_string($data['title']);
    $org = $mysqli->real_escape_string($data['organization']);
    $desc = $mysqli->real_escape_string($data['description']);
    $start = $mysqli->real_escape_string($data['start_date']);
    $end = $mysqli->real_escape_string($data['end_date']);
    $image_sql = '';
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $img = upload_file($file);
        if ($img) $image_sql = ", image='".$mysqli->real_escape_string($img)."'";
    }
    $sql = "UPDATE experiences SET title='{$title}', organization='{$org}', description='{$desc}', start_date='{$start}', end_date='{$end}'{$image_sql} WHERE id={$id}";
    return $mysqli->query($sql);
}

function delete_experience($id) {
    global $mysqli;
    $id = (int)$id;
    // Optionally: delete image file from uploads
    $row = get_experience($id);
    if ($row && !empty($row['image'])) {
        $path = __DIR__ . '/../public/' . $row['image'];
        if (file_exists($path)) @unlink($path);
    }
    return $mysqli->query("DELETE FROM experiences WHERE id={$id}");
}
```
