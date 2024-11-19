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
    <link rel="stylesheet" href="./assets/css/main.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="<?= FAV_ICO; ?>" type="image/x-icon">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top fs-5 shadow p-3 mb-2 text-white">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="index">
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
                        <a class="btn btn-dark nav-link text-white" id="btn-dark" type="button">
                            <i class="bi bi-moon-stars-fill"></i>
                        </a>

                        <a class="btn btn-light nav-link text-white" id="btn-light" type="button">
                            <i class="bi bi-brightness-high-fill"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 pt-3">
            <div class="col-lg-2 col-sm-12 col-md-12 mb-3">
                <div class="alert alert-secondary rounded-0"><strong>Step 1.</strong> Choose an option</div>
                <ul class="nav nav-underline flex-column text-center nav-fill" role="tablist">
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
                                            <input type="text" class="form-control form-control-lg mb-3 rounded-0" id="full_name_c">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="person_to_consult">Person to Visit (Required)</label>
                                            <select type="text" class="form-control form-control-lg form-select mb-3 rounded-0" id="person_to_consult"></select>
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <label for="consult_purpose">Purpose (Required)</label>
                                            <textarea type="text" class="form-control form-control-lg mb-3 rounded-0" id="consult_purpose"></textarea>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <div class="g-recaptcha" data-sitekey="6Lf1e3oqAAAAAPhU6_4MoadTgX-fua76C1AK3P-N" data-callback="enableConsult"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="gap-2 float-end mb-3">
                                        <button class="btn btn-danger rounded-0 btnClearForm" type="button">Clear</button>
                                        <button class="btn btn-success rounded-0 consultBtn" type="submit" disabled="disabled">Submit</button>
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
                            <form method="POST" class="visitorForm">
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
                                        <hr>
                                        <div class="mb-3">
                                            <div class="g-recaptcha" data-sitekey="6Lf1e3oqAAAAAPhU6_4MoadTgX-fua76C1AK3P-N" data-callback="enableVisit"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="gap-2 float-end mb-3">
                                        <button class="btn btn-danger rounded-0 btnClearForm" type="button">Clear</button>
                                        <button class="btn btn-success rounded-0 visitBtn" type="submit" disabled="disabled">Submit</button>
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

    <script src="./assets/js/theme.js"></script>

    <script>

        $(document).ready(function(){

            facultyDropdown();
            fetchData();
           
            $('#goTopBtn').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            });

            updateDateTime();
            setInterval(updateDateTime, 1000);

            $('.btnClearForm').on('click', ()=>{
                clearVisitForm();
            });

            $('.visitBtn').on('click', ()=>{
                var full_name = $('#full_name').val()
                var person_to_visit = $('#person_to_visit').val()
                var visit_purpose = $('#visit_purpose').val()
                var recaptcha = $('.g-recaptcha-response').val();

                $.ajax({
                    url: 'submit-visit',
                    method: "POST",
                    data: {
                        full_name: full_name,
                        person_to_visit: person_to_visit,
                        visit_purpose: visit_purpose,
                        recaptcha: recaptcha
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend: function(){
                        $('.visitBtn').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Submitting...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then( ()=> $('.visitBtn').html('Submit').prop('disabled', false) );

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> $('.visitBtn').html('Submit').prop('disabled', false))
                            .then(()=> fetchData())
                            .then( () => clearVisitForm());

                            return false;
                        } 
                    }
                })
            });

            $('.consultBtn').on('click', ()=>{
                var full_name_c = $('#full_name_c').val()
                var person_to_consult = $('#person_to_consult').val()
                var consult_purpose = $('#consult_purpose').val()
                var recaptcha_c = $('.g-recaptcha-response').val();

                $.ajax({
                    url: "submit-consult",
                    method: "POST",
                    data: {
                        full_name_c: full_name_c,
                        person_to_consult: person_to_consult,
                        consult_purpose: consult_purpose,
                        recaptcha_c: recaptcha_c,
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('.consultBtn').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Submitting...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then( ()=> $('.consultBtn').html('Submit').prop('disabled', false) );

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> $('.consultBtn').html('Submit').prop('disabled', false))
                            .then(()=> fetchData())
                            .then( () => clearVisitForm());

                            return false;
                        }

                    }
                });
            })
        });

        const clearVisitForm = ()=> {

            $('#full_name').val('')
            $('#person_to_visit').val('')
            $('#visit_purpose').val('')

            $('#full_name_c').val('')
            $('#person_to_consult').val('')
            $('#consult_purpose').val('')
        }

        function enableVisit(){
            $('.visitBtn').prop('disabled', false);
           
        }

        function enableConsult(){
            $('.consultBtn').prop('disabled', false);
        }

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

        const facultyDropdown = ()=>{
            $.ajax({
                url: "list-faculty",
                method: "GET",
                dataType: "JSON",
                cache: false,
                success:function(data){
                    if(data.success === false){
                        Swal.fire({
                            title: "Attention",
                            text: data.result,
                            icon: "info"
                        });

                        return false;
                    }

                    if(data.success === true){

                        Array.isArray(data.result) ? 
                            data.result.map((item) => {

                                var availability = "";

                                if(item.availability == 1) {

                                    availability = "(available)";

                                }else if(item.availability == 2) {

                                    availability = "(busy)";

                                }else if(item.availability == 3) {

                                    availability = "(away)";

                                }else{

                                    availability = "(not set)";

                                }

                                $('#person_to_consult').append(`
                                    <option value="${item.uuid}">${item.faculty_name} ${availability}</option>
                                `)
                                $('#person_to_visit').append(`
                                    <option value="${item.uuid}">${item.faculty_name} ${availability}</option>
                                `)
                                
                            })
                        : "";

                    }
                }
            })
        }


        const fetchData = ()=>{
            $.ajax({
                url: "fetch-request",
                method: "GET",
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
                        $('#emptyImageResult').attr('src', './assets/img/empty.svg')
                        return false;
                    }

                    if(data.success === true){
                        $('#req_logs').html(``);
                        Array.isArray(data.result) ? 
                            data.result.map( (item) => {
                                var category = (item.req_category == 1) ? "consultation" : "visitor";
                                var icon = (item.is_accepted == 1) ? '<i class="bi bi-check2-circle text-success"></i>' : '<i class="bi bi-hourglass-top text-primary"></i>';
                                var badgeColor = (item.req_category == 1) ? 'bg-primary' : 'bg-success';
                                // var timeOut = (item.time_out === null) ? '' : item.time_out;

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
                                                Date: ${item.date_visited} <br />Time In: ${item.time_in}
                                            </small>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="fw-900"> ${icon} ${item.person_to_visit}</h4>
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