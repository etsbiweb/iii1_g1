<?php
// PDO connection
$host = 'localhost';
$db   = 'redcross';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Greška u konekciji: " . $e->getMessage());
}

// Check if id is provided
if (!isset($_GET['id'])) {
    die("ID volontera nije specificiran.");
}

$id = (int)$_GET['id'];

// Delete volunteer
$stmt = $pdo->prepare("DELETE FROM volonter WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin.php");
exit;
?>
