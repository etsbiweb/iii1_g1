
<?php
session_start();

// Konekcija na bazu putem PDO
$host = 'localhost';
$db   = 'redcross';
$user = 'root';
$pass = ''; // Promijeni ako tvoj MySQL ima lozinku
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Greška pri povezivanju s bazom: " . $e->getMessage());
}

// Dohvati podatke iz forme
$korisnickoIme = $_POST['adminIme'] ?? '';
$lozinka = $_POST['adminSifra'] ?? '';

// Prvo provjeri postoji li korisnik s tim imenom
$sql = "SELECT * FROM administratori WHERE korisnicko_ime = :ime";
$stmt = $pdo->prepare($sql);
$stmt->execute([':ime' => $korisnickoIme]);
$admin = $stmt->fetch();

if ($admin && password_verify($lozinka, $admin['lozinka'])) {
    // Prijava uspješna
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_ime'] = $admin['korisnicko_ime'];
    header("Location: admin.php");
    exit();
} else {
    // Neuspješna prijava
    echo "<script>alert('Pogrešno korisničko ime ili lozinka!'); window.location.href = 'admin_prijava.html';</script>";
    exit();
}
?>
