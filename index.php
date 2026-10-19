<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Result System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background-color: white;
      padding: 40px;
      width: 350px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    h1 {
      margin-bottom: 10px;
    }

    p {
      color: #666;
      margin-bottom: 25px;
    }

    input[type="email"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <h1>Student Result System</h1>
    <p>Enter your email to continue</p>
    <form action="login.php" method="POST"> <input type="email" name="email" placeholder="Enter your email" required> <button type="submit">Login</button> </form>
  </div>
</body>

</html>