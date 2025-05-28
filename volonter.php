<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";

$conn = new mysqli($servername, $username, $password, $dbname);

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['ime'], $_POST['prezime'], $_POST['datum_rodenja'], $_POST['email'], $_POST['broj_telefona'], $_POST['agree'])
    ) {
        $ime = trim($_POST['ime']);
        $prezime = trim($_POST['prezime']);
        $datum_rodjenja = $_POST['datum_rodenja'];
        $email = trim($_POST['email']);
        $broj_telefon = trim($_POST['broj_telefona']);
        $agree = $_POST['agree'];

        if ($ime !== '' && $prezime !== '' && $datum_rodjenja !== '' && $email !== '' && $broj_telefon !== '' && $agree === 'on') {
            $stmt = $conn->prepare("INSERT INTO volonter (ime, prezime, datum_rodenja, email, broj_telefona) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $ime, $prezime, $datum_rodjenja, $email, $broj_telefon);
            $stmt->execute();
            $stmt->close();

            $success = true;
            $error = '';
        } else {
            $error = 'Molimo vas da popunite sva polja i prihvatite pravila Crvenog križa.';
        }
    } else {
        $error = 'Molimo vas da popunite sva polja i prihvatite pravila Crvenog križa.';
    }
}
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Volonter Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Montserrat', sans-serif; background-color: #f2f2f2;">

  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
      <div class="card-body p-4">
        <h2 class="card-title text-center text-danger mb-4">Prijava za volontiranje</h2>
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                Hvala što ste se prijavili za volontiranje!
                <a href="index.php" class="btn btn-success">Vrati se na početnu</a>
            </div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
              <label for="ime" class="form-label">Ime</label>
              <input type="text" class="form-control" id="ime" name="ime" required value="<?= isset($ime) ? htmlspecialchars($ime) : '' ?>" />
            </div>
            <div class="mb-3">
              <label for="prezime" class="form-label">Prezime</label>
              <input type="text" class="form-control" id="prezime" name="prezime" required value="<?= isset($prezime) ? htmlspecialchars($prezime) : '' ?>" />
            </div>
            <div class="mb-3">
              <label for="datum_rodenja" class="form-label">Datum rođenja</label>
              <input type="date" class="form-control" id="datum_rodenja" name="datum_rodenja" required value="<?= isset($datum_rodenja) ? htmlspecialchars($datum_rodenja) : '' ?>" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
            </div>
            <div class="mb-3">
              <label for="broj_telefona" class="form-label">Broj telefona</label>
              <input type="text" class="form-control" id="broj_telefona" name="broj_telefona" required value="<?= isset($broj_telefona) ? htmlspecialchars($broj_telefona) : '' ?>" />
            </div>
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="agree" name="agree" required <?= isset($agree) && $agree === 'on' ? 'checked' : '' ?> />
              <label class="form-check-label" for="agree">
                  Slažem se sa <a href="https://ckfbih.ba/naela-crvenog-kria/">principima Crvenog križa.</a> <br/>
              </label>
            </div>
            <button type="submit" class="btn btn-danger w-100">Volontiraj</button>
        </form>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>