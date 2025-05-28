<?php
session_start();
include 'includes/db.inc.php';


// dodaj_donaciju.php

$host = "localhost";
$dbname = "redcross";
$username = "root"; // promijeni po potrebi
$password = "";     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $korisnickoIme = $_POST['adminIme'] ?? '';
    $sifra = $_POST['adminSifra'] ?? '';
    $datum = $_POST['datumDonacije'] ?? '';
    $vrijeme = $_POST['vrijemeDonacije'] ?? '';

    $stmt = $pdo->prepare("SELECT id, lozinka FROM administratori WHERE korisnicko_ime = :korisnicko_ime");
    $stmt->execute(['korisnicko_ime' => $korisnickoIme]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($sifra, $admin['lozinka'])) {
        $insert = $pdo->prepare("INSERT INTO donacije (datum_donacije, vrijeme_donacije, admin_id) 
                                 VALUES (:datum, :vrijeme, :admin_id)");
        $insert->execute([
            'datum' => $datum,
            'vrijeme' => $vrijeme,
            'admin_id' => $admin['id']
        ]);

        header("Location: ../prikazdonacija.php");
    } else {
        echo "❌ Pogrešno korisničko ime ili lozinka.";
    }

} catch (PDOException $e) {
    echo "❌ Greška: " . $e->getMessage();
}


?>