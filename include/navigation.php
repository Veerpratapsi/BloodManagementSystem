
<body>
<!-- Navigation starts -->
<nav id="mainNav" class="navbar fixed-top navbar-default navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="./index.php">BloodManagementSystem</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <!-- Other nav items can go here -->
    </ul>
    
    <ul class="navbar-nav form-inline my-2 my-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="loginDropdown">
          <a class="dropdown-item" href="login.php" onclick="login('admin')"> Admin</a>
          <a class="dropdown-item" href="hospital_login.php" onclick="login('hospital')"> Hospital</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<script src="script.js"></script>