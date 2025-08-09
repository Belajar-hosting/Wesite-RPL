<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      height: 100vh;
      background: linear-gradient(-45deg, red, blue, green);
      background-size: 600% 600%;
      animation: gradientMove 15s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .dashboard {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 40px;
      text-align: center;
      color: white;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      animation: fadeInUp 1s ease-out;
    }

    .dashboard h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      animation: bounceIn 1.2s ease;
    }

    .info p {
      font-size: 1.2rem;
      margin: 10px 0;
    }

    @keyframes fadeInUp {
      0% { transform: translateY(20px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes bounceIn {
      0% { transform: scale(0.8); opacity: 0; }
      60% { transform: scale(1.05); opacity: 1; }
      100% { transform: scale(1); }
    }

    .btn-custom {
      background-color: white;
      color: black;
      border: none;
      padding: 10px 20px;
      border-radius: 30px;
      font-weight: bold;
      margin-top: 20px;
      transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
      transform: scale(1.1);
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="dashboard">
   <img src="unwaha.png" alt="Logo UNWAHA" style="width: 5cm;">
   <br>
   <br>
        <h1>Selamat Datang 😉</h1>
    <div class="info">
      <p><strong>NIM: 2002040923</strong> </p>
      <p><strong>Nama: ARDISA AUDI K.S</strong> </p>
      <p><strong>Program Studi: INFORMATIKA</strong> Informatika</p>
    </div>
    <a href="crud.php" class="btn btn-custom">Lihat Data Mahasiswa</a>
  </div>
</body>
</html>
