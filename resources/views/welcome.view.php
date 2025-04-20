<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Pocketframe</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background: linear-gradient(135deg, #0A0A33, #1E1E6E);
      color: #fff;
    }

    .navbar {
      background: #0A0A33;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .brand {
      font-size: 30px;
      font-weight: bold;
      color: #2A5FFF;
    }

    .nav-links {
      list-style: none;
      padding: 0;
      display: flex;
    }

    .nav-links li {
      margin: 0 15px;
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      font-size: 16px;
    }

    .hero {
      padding: 60px 20px;
    }

    .hero h1 {
      font-size: 48px;
      margin-bottom: 10px;
      color: #2A5FFF;
    }

    .btn-primary {
      background: #2A5FFF;
      color: #fff;
      padding: 15px 30px;
      text-decoration: none;
      font-size: 18px;
      border-radius: 5px;
      display: inline-block;
      margin-top: 20px;
    }

    .info-section {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 40px;
    }

    .info-box {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      margin: 15px;
      width: 280px;
      border-radius: 10px;
    }

    .btn-secondary {
      background: #2A5FFF;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 10px;
      border-radius: 5px;
    }

    .footer {
      margin-top: 40px;
      padding: 20px;
      background: #0A0A33;
      color: #2A5FFF;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <span class="brand">Pocketframe</span>
    <ul class="nav-links">
      <!-- <li><a href="#">Home</a></li> -->
      <!-- <li><a href="#">Docs</a></li> -->
      <!-- <li><a href="#">Login</a></li> -->
    </ul>
  </nav>
  <header class="hero">
    <h1>🚀 Congratulations! 🚀</h1>
    <p>Your Pocketframe installation is successful!</p>
    <a href="https://pocketframe.github.io/docs/" target="_blank" class="btn-primary">Read The Docs</a>
  </header>
  <section class="info-section">
    <div class="info-box">
      <h2>📖 Documentation</h2>
      <p>Master Pocketframe with our easy-to-follow guides.</p>
      <a href="https://pocketframe.github.io/docs/" target="_blank" class="btn-secondary">View Docs »</a>
    </div>
    <div class="info-box">
      <h2>🌍 Community</h2>
      <p>Engage with fellow developers and share knowledge.</p>
      <a href="https://pocketframe.github.io/docs" target="_blank" class="btn-secondary">Join Community »</a>
    </div>
    <div class="info-box">
      <h2>🛠 Packages</h2>
      <p>Boost your projects with powerful add-ons.</p>
      <a href="https://pocketframe.github.io/docs" target="_blank" class="btn-secondary">Browse Packages »</a>
    </div>
  </section>
  <footer class="footer">
    <p>✨ Powered by Pocketframe ✨</p>
  </footer>
</body>

</html>
