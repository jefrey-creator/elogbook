<?php 
    include_once './private/ini.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="<?= FAV_ICO; ?>" type="image/x-icon">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top fs-5 shadow p-3 mb-2">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index">
                <img src="<?= LOGO; ?>" alt="Logo" width="60" height="60" class="d-inline-block align-text-center"> <?= TITLE; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mx-auto">
                    <h4 id="clock" class="fw-500"></h4>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-dark nav-link" id="btn-dark" type="button">
                            <i class="bi bi-moon-stars-fill"></i>
                        </a>

                        <a class="btn btn-light nav-link" id="btn-light" type="button">
                            <i class="bi bi-brightness-high-fill"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 pt-3">
            <div class="col-lg-2 col-sm-12 col-md-12">
                <div class="alert alert-secondary rounded-0"><strong>Step 1.</strong> Choose an option</div>
                <ul class="nav nav-pills flex-column text-center nav-fill" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active rounded-0" href="#" id="consult-tab" data-bs-toggle="tab" data-bs-target="#consult-tab-pane" type="button" role="tab" aria-controls="consult-tab-pane" aria-selected="true">CONSULTATION</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" href="#" id="visitor-tab" data-bs-toggle="tab" data-bs-target="#visitor-tab-pane" type="button" role="tab" aria-controls="visitor-tab-pane" aria-selected="true">VISITOR</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="alert alert-primary rounded-0"><strong>Step 2.</strong> Fill out form.</div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="consult-tab-pane" role="tabpanel" aria-labelledby="consult-tab" tabindex="0">
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h4 class="card-title text-uppercase">Consultation Logbook</h4>
                            </div>
                            <form method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="name">Full Name (Required)</label>
                                            <input type="text" class="form-control form-control-lg mb-3 rounded-0" id="full_name">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="person_to_consult">Person to Visit (Required)</label>
                                            <select type="text" class="form-control form-control-lg form-select mb-3 rounded-0" id="person_to_consult"></select>
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="consult_purpose">Purpose (Required)</label>
                                            <textarea type="text" class="form-control form-control-lg mb-3 rounded-0" id="consult_purpose"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="gap-2 float-end mb-3">
                                        <button class="btn btn-danger rounded-0">Clear</button>
                                        <button class="btn btn-success rounded-0">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="visitor-tab-pane" role="tabpanel" aria-labelledby="visitor-tab" tabindex="0">
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h4 class="card-title text-uppercase">Visitor's Logbook</h4>
                            </div>
                            <form method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="name">Full Name (Required)</label>
                                            <input type="text" class="form-control form-control-lg mb-3" id="full_name">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="person_to_visit">Person to Visit (Required)</label>
                                            <select type="text" class="form-control form-control-lg form-select mb-3" id="person_to_visit"></select>
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="visit_purpose">Purpose (Required)</label>
                                            <textarea type="text" class="form-control form-control-lg mb-3" id="visit_purpose"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="gap-2 float-end mb-3">
                                        <button class="btn btn-danger rounded-0">Clear</button>
                                        <button class="btn btn-success rounded-0">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <div class="alert alert-success rounded-0">
                    <strong>Step 3.</strong> View Logs
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

    <script src="./assets/js/theme.js"></script>

    <script>

        $(document).ready(function(){
           
            $('#goTopBtn').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            });

            updateDateTime();
            setInterval(updateDateTime, 1000);
        })

        function updateDateTime() {

            let now = new Date();
            
            // Get date components
            let day = now.getDate();
            let month = now.getMonth();
            let year = now.getFullYear();
            
            // Get time components
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            
            // Format time to 12-hour format and AM/PM
            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // 0 becomes 12
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            
            // Define month names array
            const months = ["Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec."];

            // Format the final date and time string
            let formattedDateTime = `${months[month]} ${day}, ${year} ${hours}:${minutes}:${seconds} ${ampm}`;
            
            // Update the content of the <h1> with the formatted date and time
            document.getElementById('clock').textContent = formattedDateTime;
        }

        

        // const fetchData = ()=>{
        //     console.log('data1');
        // }

        // setInterval(fetchData, 5000);
  </script>
</body>
</html>