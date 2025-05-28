<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin prijava | Crveni križ FBiH</title>
  
  <!-- Font i Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f2f2f2;
      font-family: 'Montserrat', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(128, 0, 0, 0.2);
      border-top: 6px solid #dc3545;
      width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #dc3545;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #dc3545;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #a30000;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Admin prijava</h2>
    <form action="obradadmina.php" method="POST">
      <label for="adminIme">Korisničko ime:</label>
      <input type="text" id="adminIme" name="adminIme" required>

      <label for="adminSifra">Šifra:</label>
      <input type="password" id="adminSifra" name="adminSifra" required>

      <input type="submit" value="Prijavi se">
    </form>
  </div>

</body>
</html>
