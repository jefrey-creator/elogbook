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
                                <a class="nav-link " href="dashboard"><i class="bi bi-hourglass-split"></i> Waiting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="accepted"><i class="bi bi-check2-circle"></i> Accepted</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="done"><i class="bi bi-check2-all"></i> Done</a>
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
                        Legend: <i class="bi bi-check2-circle text-success"></i> - Accepted |
                        <i class="bi bi-hourglass-split text-primary"></i> - Waiting
                    </small>
                </div>
                <div class="auto_refresh">
                    <div id="req_logs" class="h5"></div>
                    <img alt="" id="emptyImageResult" class="img-fluid">
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

            fetchData()

            $('#goTopBtn').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            });
        })

        const fetchData = ()=>{

            $.ajax({
                url: "fetch-request",
                method: "GET",
                data:{
                    is_accepted: 1,
                    is_completed: 1
                },
                dataType: "json",
                cache: false,
                beforeSend:function(){
                    $('#req_logs').html(`
                        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `);
                },
                success:function(data){
                    // console.log(data);

                    if(data.success === false){
                        $('#req_logs').html(data.result);
                        $('#emptyImageResult').attr('src', '../assets/img/empty.svg')
                        return false;
                    }

                    if(data.success === true){

                        $('#req_logs').html(``);

                        Array.isArray(data.result) ? 
                            data.result.map( (item) => {
                                var category = (item.req_category == 1) ? "consultation" : "visitor";
                                var badgeColor = (item.req_category == 1) ? 'bg-primary' : 'bg-success';
                                var timeOut = (item.time_out === null) ? '' : item.time_out;
                                var action_taken = (item.action_taken == null) ? 'N/A' : item.action_taken;
                                $('#req_logs').append(
                                    `
                                    <div class="card mb-3 rounded-0">
                                        <div class="card-header">
                                            <blockquote class="blockquote mb-0">
                                                <h5 class="mb-4">
                                                    <i class="bi bi-person"></i> ${item.full_name}
                                                    <i class="badge ${badgeColor} float-end">${category}</i>
                                                </h5>
                                                <footer class="blockquote-footer">
                                                    ${item.purpose}
                                                </footer>
                                            </blockquote>
                                            <hr>
                                            <small class="text-muted">
                                                Date: ${item.date_visited} <br />In: ${item.time_in} <br /> Out: ${timeOut}
                                            </small>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <h4 class="fw-900 mb-4"> <i class="bi bi-check2-all text-success"></i> ${item.person_to_visit}</h4>
                                                <footer class="blockquote-footer">
                                                    ${action_taken}
                                                </footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                    `
                                );
                            })
                        : "";
                    }
                }
            })
        }

        setInterval(fetchData, 10000);
    </script>
</body>
</html>