<?php 
    include_once 'auth.php';
    $page = "users";
?>
<?php 
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
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="user-management">
                                    <?= (isset($_GET['id'])) ? 'Update Profile' : 'Add New'; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view-user">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="uuid" value="<?= (isset($_GET['id'])) ? trim($_GET['id']) : ''; ?>">
                        <?php 
                            if(isset($_GET['id'])){
                        ?>
                        <div class="row">
                            <h5 class="pb-3">Profile Information</h5>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">First Name (Required)</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="fname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">Middle Name</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="mname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">Last Name (Required)</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="lname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="email">Sex (Required)</label>
                                <select class="form-control form-control-lg form-select mb-3" id="sex">
                                    <option value="">--select--</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            }else{
                        ?>
                        <div class="row">
                            <h5 class="pb-3">Account Information</h5>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="email">Email Address (Required)</label>
                                <input type="email" class="form-control form-control-lg" id="email">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="password">Password (Required)</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" id="password">
                                    <div class="input-group-text" style="cursor: pointer">
                                        <span id="toggle-password">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" onclick="passwGen()" class="float-start">Generate Password</a>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="email">User Type (Required)</label>
                                <select class="form-control form-control-lg form-select" id="isAdmin">
                                    <option value="">--select--</option>
                                    <option value="1">Admin</option>
                                    <option value="0">Faculty</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h5 class="pb-3">Profile Information</h5>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">First Name (Required)</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="fname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">Middle Name</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="mname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="fname">Last Name (Required)</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="lname">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="email">Sex (Required)</label>
                                <select class="form-control form-control-lg form-select mb-3" id="sex">
                                    <option value="">--select--</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <hr>
                        <button class="btn btn-primary float-end btnCreateUser" type="button" onclick="createUser()">
                            <?= (isset($_GET['id'])) ? 'Save changes' : 'Create User'; ?>
                        </button>
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
            $('#toggle-password').on('click', function(){
                const passwordInput = document.getElementById('password');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    $('#toggle-password').html(`<i class="bi bi-eye-slash-fill"></i>`); // Change icon to "hide"
                } else {
                    passwordInput.type = 'password';
                    $('#toggle-password').html(`<i class="bi bi-eye-fill"></i>`) // Change icon to "show"
                }
            });
            getUserData();
        });


        const passwGen = () =>{
            $('#password').val(generatePassword(10));
            return false;
        }
        
        function generatePassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }

            return password;
        }

        const createUser = ()=>{
            
            var uuid = $('#uuid').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var isAdmin = $('#isAdmin').val();
            var fname = $('#fname').val();
            var mname = $('#mname').val();
            var lname = $('#lname').val();
            var sex = $('#sex').val();

            $.ajax({
                url: "create-user",
                method: "POST",
                data:{
                    email: email,
                    password: password,
                    isAdmin: isAdmin,
                    fname:fname,
                    mname: mname,
                    lname: lname,
                    sex: sex,
                    uuid: uuid
                },
                cache: false,
                dataType: "json",
                beforeSend: function(){
                    $('.btnCreateUser').html(`
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Processing...</span>
                    `).prop('disabled', true);
                },
                success:function(data){

                    if(data.success === false){
                        Swal.fire({
                            title: "Error",
                            text: data.result,
                            icon: "error"
                        }).then( ()=> {
                            $('.btnCreateUser').html(`Create User`).prop('disabled', false);
                        });

                        return false;
                    }

                    if(data.success === true){
                        Swal.fire({
                            title: "Success",
                            text: data.result,
                            icon: "success"
                        }).then( ()=> {
                            location.href = "view-user"
                        });

                        return false;
                    }
                }
            });

        }

        const getUserData = () =>{
            var uuid = $('#uuid').val();

            $.ajax({
                url: "get-user-data",
                method: "GET",
                data: {
                    uuid: uuid,
                },
                dataType: "JSON",
                cache: false,
                success:function(data){

                    console.log(data);

                    if(data.success === true){

                        $('#fname').val(data.result.f_name);
                        $('#mname').val(data.result.m_name);
                        $('#lname').val(data.result.l_name);
                        $('#sex [value="'+data.result.sex+'"]').attr('selected', 'selected');

                        return false;
                    }
                }
            })
        }


    </script>
</body>
</html>