<?php 
    include_once 'auth.php';
    $page = "dashboard";

    include_once '../private/ini.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="../<?= FAV_ICO; ?>" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/main.css">

</head>
<body>
    <?php include_once 'nav.php';?>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="dashboard">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="waiting">Waiting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ongoing">Ongoing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="done">Done</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="alert alert-success rounded-0">
                    <strong> View Logs</strong>
                    <small class="float-end">
                        Legend: <i class="bi bi-chat-dots text-success"></i> - Ongoing |
                        <i class="bi bi-hourglass-split text-primary"></i> - Waiting
                    </small>
                </div>
                <div class="auto_refresh">
                    <?php 
                        for($i = 0; $i < 5; $i++){
                        ?>
                        <div class="card mb-3 rounded-0">
                            <div class="card-header">
                                <h4 class="fw-900"><i class="bi bi-hourglass-split text-primary"></i> Person to visit</h4> <i class="badge bg-success float-end">visitor</i>
                                <hr>
                                <small class="fw-100">
                                    Date: 11/10/2024 <br />Time In: 8:00 AM <br /> Time Out: 12:00 PM
                                </small>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <h5 class="mb-4">
                                        Name of visitor
                                    </h5>
                                    <footer class="blockquote-footer">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem suscipit iste doloremque amet dolor nemo veniam! Provident amet quia assumenda praesentium, quibusdam minus, iste voluptate, porro soluta dolores at facere!
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                    <div class="card mb-3 rounded-0">
                        <div class="card-header">
                            <h4 class="fw-900"><i class="bi bi-chat-dots text-success"></i> Person to visit</h4> <i class="badge bg-primary float-end">consultation</i>
                            <hr>
                            <small class="fw-100">
                                Date: 11/10/2024 <br />Time In: 8:00 AM <br /> Time Out: 12:00 PM
                            </small>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <h5 class="mb-4">
                                    Name of visitor
                                </h5>
                                <footer class="blockquote-footer">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem suscipit iste doloremque amet dolor nemo veniam! Provident amet quia assumenda praesentium, quibusdam minus, iste voluptate, porro soluta dolores at facere!
                                </footer>
                                
                                <footer class="blockquote-footer">
                                    Action Taken
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="goTopBtn" class="btn btn-primary float-end">
        <i class="bi bi-arrow-up-circle"></i> Go to Top
    </button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../assets/js/theme.js"></script>
    <script>

        $(document).ready(function(){

            $('#goTopBtn').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            });
        })

    </script>
</body>
</html>