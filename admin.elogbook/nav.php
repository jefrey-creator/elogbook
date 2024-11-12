<nav class="navbar navbar-expand-lg sticky-top shadow p-3 mb-2">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index">
            <img src="../<?= LOGO ?>" alt="Logo" width="60" height="60" class="d-inline-block align-text-center rounded-2"> <?= TITLE; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <?php 
                if(isset($_SESSION['token'])){
                ?>
                <li class="nav-item">
                    <a href="dashboard" class="nav-link <?= ($page == "dashboard") ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="user-management" class="nav-link <?= ($page == "users") ? 'active' : '' ?>">
                        <i class="bi bi-people-fill"></i>    
                        User Management
                    </a>
                </li>
                <li class="nav-item">
                    <a href="email-config" class="nav-link <?= ($page == "config") ? 'active' : '' ?>">
                        <i class="bi bi-sliders"></i>    
                        Email Configuration
                    </a>
                </li>
                <?php 
                    }
                ?>
            </ul>
            
            <ul class="navbar-nav ml-auto fs-5">
                <li class="nav-item">
                    <a class="btn btn-dark nav-link" id="btn-dark" type="button">
                        <i class="bi bi-moon-stars-fill"></i>
                    </a>

                    <a class="btn btn-light nav-link" id="btn-light" type="button">
                        <i class="bi bi-brightness-high-fill"></i>
                    </a>
                </li>
                <?php 
                    if(isset($_SESSION['token'])){
                    ?>
                    <li class="nav-item">
                        <a href="javascript::void(0)" class="nav-link text-danger" onclick="logOut()">Log Out</a>
                    </li>
                    <?php 
                    }
                ?>
                
            </ul>
        </div>
    </div>
</nav>
<div class="modal" id="logOutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-body">
        <h3 class="modal-title fs-5 text-danger">You are about to end your current session. Please save your work before continuing.</h3>
        <br>
        <span class="mb-4">
            If you accept, you will be logged out.
        </span>
        <div class="float-end mt-4">
            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
            <a  href="../logout" class="btn btn-danger ">Accept & log out</a>
        </div>
      </div>
    </div>
  </div>
</div>