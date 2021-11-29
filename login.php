<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="style/login_style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip" />
    <div class="cover">
      <div class="front">
        <div class="text">
          <span class="text-1">Attendance <br />
            System</span>
        </div>
      </div>
      <div class="back">
        <div class="text">
          <span class="text-1">Attendance<br />
            System</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <form action="logic/login_query.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your username" name="InputUsername" required />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="InputPassword" required />
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit" />
              </div>
              <div class="text sign-up-text">
                Fogot your password? <label for="flip">Reset it now</label>
              </div>
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">New Password</div>
          <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" required />
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Create new password" required />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirm your password" required />
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit" />
              </div>
              <div class="text sign-up-text">
                Remember your password? <label for="flip">Login now</label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>