<?php 
    include_once 'auth.php';
    $page = "config";
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

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
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
                                <a class="nav-link active" aria-current="page" href="email-config">
                                    <?= (isset($_GET['id'])) ? 'Update Configuration' : 'Add New'?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view-config">View</a>
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
                        <input type="hidden" id="mail_id" value="<?= (isset($_GET['id'])) ? trim($_GET['id']) : ''; ?>">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="tag">Tag</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="mail_tag" <?= (isset($_GET['id'])) ? 'readonly' : '' ?>>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="mail_subject">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="subject">Message</label>
                                <textarea type="text" class="form-control form-control-lg mb-3" id="mail_body"></textarea>
                            </div>
                            <hr>
                            <button class="btn btn-primary float-end" id="btnConfig" type="button">
                                <?= (isset($_GET['id'])) ? 'Save changes' : 'Save Config'?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- summernote  -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../assets/js/theme.js"></script>
    <script>

        $(document).ready(function(){

           
            $('#mail_body').summernote({
                tabsize: 2,
                height: 280,
                toolbar: [
                    ['style', ['style']],
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert',['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
            });


            $('#btnConfig').on('click', ()=>{
            
                var mail_id = $('#mail_id').val();
                var mail_tag = $('#mail_tag').val();
                var mail_subject = $('#mail_subject').val();
                var mail_body = $('#mail_body').val();

                $.ajax({
                    url: "add-config",
                    method: "POST",
                    data: {
                        mail_id: mail_id,
                        mail_tag: mail_tag,
                        mail_subject: mail_subject,
                        mail_body: mail_body
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#btnConfig').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then( ()=> {
                                $('#btnConfig').html(`Save Config`).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> {
                                location.href = "view-config"
                            });

                            return false;
                        }
                    }
                })
            });

            const getConfigData = (mail_id)=>{
                var mail_id = $('#mail_id').val();
                $.ajax({
                    url: "select-config",
                    method: "GET",
                    data: {
                        mail_id: mail_id
                    },
                    dataType: "JSON",
                    cache: false,
                    success:function(data){

                        if(data.success === true){
                            
                            var mail_tag = data.result.mail_tag;
                            var mail_subject = data.result.mail_subject;
                            var mail_body = data.result.mail_body;

                            $('#mail_tag').val(mail_tag);
                            $('#mail_subject').val(mail_subject);
                            $('#mail_body').summernote('code', mail_body);

                            return false;

                        }
                    }
                })
            }

            getConfigData();

        });
    </script>
</body>
</html>