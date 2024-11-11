$(document).ready(function(){
    
    defaultTheme();

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