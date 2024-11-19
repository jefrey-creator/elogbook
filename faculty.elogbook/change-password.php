<?php 
    include_once 'auth.php';
    $page = "password";

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
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                                <img src="../assets/img/change-password.svg" alt="login svg" class="img-fluid text-center ">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="change_password">
                                    <h4 class="text-uppercase">Change Password</h4>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control-lg form-control" id="current_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control-lg form-control" id="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password">Confirm New Password</label>
                                        <input type="password" class="form-control-lg form-control" id="confirm_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="show_password" id="password_show">
                                            <input type="checkbox" id="show_password">
                                            Show Password
                                        </label>
                                    </div>
                                    <button class="btn btn-primary btn-lg w-100" type="submit" id="onChange">Save New Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../assets/js/theme.js"></script>
    <script>

        $(document).ready(function(){
            $('#show_password').on('click', function(){
                // console.log('checked')
                if($('input[type="checkbox"]').is(':checked')){
                    // console.log('checked')
                    $('input[type="password"]').attr('type', 'text');
                }else{
                    $('input[type="text"]').attr('type', 'password');
                }
            });


            $('#onChange').on('click', ()=>{
                var current_password = $('#current_password').val();
                var new_password = $('#new_password').val();
                var confirm_password = $('#confirm_password').val();

                $.ajax({
                    url: "reset-password",
                    method: "POST",
                    data:{
                        current_password: current_password,
                        new_password: new_password,
                        confirm_password: confirm_password
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#onChange').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Please wait...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){

                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "info"
                            }).then( ()=> {
                                $('#onChange').html(`Save New Password`).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> {
                                location.href = "dashboard"
                            });

                            return false;
                        }
                    }
                })
            })
        })

    </script>
</body>
</html>