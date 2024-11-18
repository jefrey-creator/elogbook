<?php 
    include_once 'auth.php';
    $page = "users";
    $acct = new Account();
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
    <link rel="stylesheet" href="../assets/css/index.css">

    <style>
        #contextMenu {
            display: none;
            position: absolute;
            z-index: 1000;
        }

        .menuContainer a {
            display: block; /* Make the link a block element */
            width: 100%; /* Take full width of the container */
            text-align: left; /* Center text (optional) */
            padding: 10px; /* Add some padding */
            text-decoration: none; /* Remove underline */
            color: black; /* Default text color */
        }

        .menuContainer a:hover {
            background-color: rgba(255, 255, 255, 0.2); 
            border-radius: 5px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            backdrop-filter: blur(10px); /* Blurs the background behind the element */
            color: #ffffff; /* Text color for better readability */
        }
    </style>
</head>
<body oncontextmenu="return false;">
    <?php include_once 'nav.php';?>
    
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" href="user-management">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="view-user">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sex</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $users = $acct->list_users();

                                    foreach($users as $user){
                                    ?>
                                    <tr oncontextmenu="configMenu('<?= $user->uuid ?>')">
                                        <td><?= ($user->isBlocked == 1) ? '<span class="badge bg-danger">blocked</span>' : '<span class="badge bg-success">active</span>' ?></td>
                                        <td><?= $user->faculty_name; ?></td>
                                        <td><?= $user->email; ?></td>
                                        <td><?= ($user->sex == 1) ? "Male" : "Female"; ?></td>
                                        <td><?= ($user->isAdmin == 1) ? "Admin" : "Faculty"; ?></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- menu option  -->
    <div class="modal" id="optionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="menuContainer">
                        <input type="hidden" id="user_id">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="#" id="updateOption" class="fs-6 text-decoration-none text-primary">
                                    <i class="bi bi-pencil"></i>
                                    Update Profile
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="javascript:void(0)" id="BlockOption" class="fs-6 text-decoration-none text-danger">
                                    <i class="bi bi-ban"></i>
                                    Block | Unblocked
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="javascript:void(0)" id="resetPasswordOption" class="fs-6 text-decoration-none text-warning">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    Reset Password 
                                </a>
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
            
           $('#BlockOption').on('click', ()=>{

                var user_id = $('#user_id').val();

                $.ajax({
                    url: "block-user",
                    method: "POST",
                    data: {
                        user_id: user_id,
                    },
                    dataType: "JSON",
                    cache: false,
                    beforeSend:function(){
                        $('#BlockOption').html(`
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
                            }).then( ()=>{
                                $('#BlockOption').html(`
                                    <i class="bi bi-ban"></i>
                                    Block
                                `).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=>{
                                location.href = "view-user";
                            });

                            return false;
                        }
                        
                    }
                })
           });


           $('#resetPasswordOption').on('click', ()=>{
            
                var user_id = $('#user_id').val();
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "Continue password reset.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, reset it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "user-reset-password",
                            method: "POST",
                            data: {
                                user_id: user_id,
                            },
                            dataType: "JSON",
                            cache: false,
                            beforeSend:function(){
                                $('#resetPasswordOption').html(`
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
                                    }).then( ()=>{
                                        $('#resetPasswordOption').html(`
                                            <i class="bi bi-ban"></i>
                                            Block
                                        `).prop('disabled', false);
                                    });

                                    return false;
                                }

                                if(data.success === true){
                                    Swal.fire({
                                        title: "Success",
                                        text: data.result,
                                        icon: "success"
                                    }).then( ()=>{
                                        location.href = "view-user";
                                    });

                                    return false;
                                }
                            }
                        })
                    }
                });
           })

        });


        const configMenu = (user_id) => {
            $('#optionModal').modal('show');
            const updateLink = document.getElementById('updateOption');
            updateLink.href = "user-management?id="+user_id;
            $('#user_id').val(user_id);
        }
       

    </script>
</body>
</html>