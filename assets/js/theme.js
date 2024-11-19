$(document).ready(function(){
    
    defaultTheme();
    getStatus();

    $('#btn-dark').on('click', () => {
        localStorage.setItem('theme', 'dark');
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('#btn-light').css('display', 'block')
        $('#btn-dark').css('display', 'none')
    });

    $('#btn-light').on('click', () => {
        localStorage.setItem('theme', 'light');
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('#btn-dark').css('display', 'block')
        $('#btn-light').css('display', 'none')
    });

});

const defaultTheme = () =>{

    if(!localStorage.getItem('theme')){
        localStorage.setItem('theme', 'light')
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('#btn-light').css('display', 'none')
        return false;
    }

    if(localStorage.getItem('theme') === "dark"){
        // $('html').attr('data-bs-theme', localStorage.set('theme', 'dark'));
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('#btn-dark').css('display', 'none')
        return false;
    }

    if(localStorage.getItem('theme') === "light"){
        // $('html').attr('data-bs-theme', localStorage.set('theme', 'light'));
        $('html').attr('data-bs-theme', localStorage.getItem('theme'));
        $('#btn-light').css('display', 'none');
        return false;
    }
}

const available = () => {
    $.ajax({
        url: "set-status",
        method: "POST",
        data: {
            availability: 1,
        },
        dataType: "json",
        cache: false,
    
        success:function(data){
            if(data.success === false){

                Swal.fire({
                    title: "Error",
                    text: data.result,
                    icon: "info"
                })
                return false;
            }

            if(data.success === true){

                Swal.fire({
                    title: "Success",
                    text: data.result,
                    icon: "success"
                }).then( ()=> {
                    getStatus();
                });

                return false;
            }
        }
    });
}

const busy = () => {
    $.ajax({
        url: "set-status",
        method: "POST",
        data: {
            availability: 2,
        },
        dataType: "json",
        cache: false,
        success:function(data){
            if(data.success === false){

                Swal.fire({
                    title: "Error",
                    text: data.result,
                    icon: "info"
                })
                return false;
            }

            if(data.success === true){

                Swal.fire({
                    title: "Success",
                    text: data.result,
                    icon: "success"
                }).then( ()=> {
                    getStatus();
                });

                return false;
            }
        }
    });
}

const away = () => {
    $.ajax({
        url: "set-status",
        method: "POST",
        data: {
            availability: 3,
        },
        dataType: "json",
        cache: false,
        
        success:function(data){
            if(data.success === false){

                Swal.fire({
                    title: "Error",
                    text: data.result,
                    icon: "info"
                })

                return false;
            }

            if(data.success === true){

                Swal.fire({
                    title: "Success",
                    text: data.result,
                    icon: "success"
                }).then( ()=> {
                    getStatus();
                });

                return false;
            }
        }
    });
}

const getStatus = ()=>{
    $.ajax({
        url: "get-status",
        method: "GET",
        dataType: "json",
        success:function(data){

            if(data.success === false){
                $('#status').html(data.result);
                return false;
            }

            if(data.success === true){

                var availability = "";

                if(data.result.availability == 1) {
                    availability = "(available)";
                }else if(data.result.availability == 2) {
                    availability = "(busy)";
                }else if(data.result.availability == 3) {
                    availability = "(away)";
                }else{
                    availability = "(not set)";
                }

                $('#status').html(availability);
                return false;
            }
        }
    })
}

const logOut = () =>{
    $('#logOutModal').modal('show');
}