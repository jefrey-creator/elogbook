<?php 
    include_once 'auth.php';
    $page = "printing";

    $logs = new Logs();

    $result = [];

    if($_GET['param'] == "all"){
     
        $result = $logs->print_all_logs();

    }elseif($_GET["param"] == "consultation"){
        $result = $logs->print_logs(1);
    }
    elseif($_GET["param"] == "visitor"){
      
        $result = $logs->print_logs(0);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE; ?> - Print logs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="../<?= FAV_ICO; ?>" type="image/x-icon">
 
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center mb-3 mt-2">
            <div class="col-sm-6">
                
            </div>
            <div class="col-sm-6 offset-3">
                <h3>
                    <img src="https://i.pinimg.com/originals/32/9c/46/329c46571cf818b8cd751368644ff893.png" alt="" height="40">
                    Republic of the Philippines
                </h3>
                <h4>
                    <strong>Cagayan State University</strong>
                    <br />
                    Gonzaga Campus
                    <br />
                    Gonzaga, Cagayan
                </h4>
                cicsgonzaga@csu.edu.ph
            </div>
        </div>
        <hr>
        <div class="row text-center mb-3 mt-2">
            <h5>College of Information and Computing Sciences</h5>
        </div>
        <hr>
        <div class="row text-center mb-3 mt-2">
            <h5>
                <?= ($_GET['param'] == "all") ? '' : strtoupper($_GET['param']). '\'s LOG BOOK'  ?>
            </h5>
        </div>
        <div class="row-fluid">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Person to Visit</th>
                            <th>Purpose</th>
                            <th>Action Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($result as $log){
                            ?>
                                <tr>
                                    <td>
                                        <?=  $log->Requester; ?>
                                    </td>
                                    <td>
                                        <?=  $log->date_visited; ?>
                                    </td>
                                    <td>
                                        <?=  $log->time_in; ?>
                                    </td>
                                    <td>
                                        <?=  $log->time_out; ?>
                                    </td>
                                    <td>
                                        <?=  $log->person_to_visit; ?>
                                    </td>
                                    <td>
                                        <?=  $log->purpose; ?>
                                    </td>
                                    <td>
                                        <?=  $log->action_taken; ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mb-3 mt-2">
            <div class="col-sm-4">
                <h4>CSU Vision</h4>
                <span class="d-flex justify-content-center">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus.
                </span>
            </div>
            <div class="col-sm-4">
                <h4>CSU Mission</h4>
                <span class="d-flex justify-content-center">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus.
                </span>
            </div>
            <div class="col-sm-4">
                <h4>Goals and Objectives</h4>
                <span class="d-flex justify-content-center">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis tempora dignissimos id in officia ab quae illo temporibus est atque labore, culpa, ipsum facilis. Dolorum magnam cum debitis ad atque!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, fuga et illo odit eligendi officia consequuntur quos minus amet earum iste nulla praesentium dicta voluptate ipsam? Est architecto fugiat accusamus.
                </span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>