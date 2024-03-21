var select_user_type = null;

$(document).ready(function () {


    $('input[id^="code_input"]').focus(function () {
        $(this).select();
    });

    $('button[id^="btnResendCode"]').click(function () {
        let uri = window.location.pathname.replace("check.php","askresendvalidation.php").slice(1);
        $axios_get(uri,null,redirectAfterAction,null);
    });
    
    $('button[id^="btnType"]').click(function () {
        select_user_type = $(this).attr("id").replace("btnType","");
        if (select_user_type == "Sportif")
        {
            $('#block_name_user').css("display","block");
            $('#block_name_assoc').css("display","none");
            $('#block_address').css("display","none");
            $('#block_mobile').css("display","none");

            $('#user_lastname').attr("required","required");
            $('#user_name').attr("required","required");
            $('#user_assoc_name').removeAttr("required");
            $('#user_address').removeAttr("required");
            $('#user_telephone').removeAttr("required");

            $('#step1').css("display","none");
            $('#step2').css("display","block");
        } 
        else if (select_user_type == "Entraineur")
        {
            $('#block_name_user').css("display","block");
            $('#block_name_assoc').css("display","none");
            $('#block_address').css("display","none");
            $('#block_mobile').css("display","block");

            $('#user_lastname').attr("required","required");
            $('#user_name').attr("required","required");
            $('#user_assoc_name').removeAttr("required");
            $('#user_address').removeAttr("required");
            $('#user_telephone').attr("required","required");

            $('#step1').css("display","none");
            $('#step2').css("display","block");
        }
        else if (select_user_type == "Association")
        {
            $('#block_name_user').css("display","none");
            $('#block_name_assoc').css("display","block");
            $('#block_address').css("display","block");
            $('#block_mobile').css("display","block");

            $('#user_lastname').removeAttr("required");
            $('#user_name').removeAttr("required");
            $('#user_assoc_name').attr("required","required");
            $('#user_address').attr("required","required");
            $('#user_telephone').attr("required","required");

 
            $('#step1').css("display","none");
            $('#step2').css("display","block");
        }
        else
        {
            select_user_type = null;

            $('#step1').css("display","block");
            $('#step2').css("display","none");
        }
    });

    $('#expandInfoPassword').click(function(){
        $('.showInfoPassword').toggle();
    });
});

function touchCode(input, count, event) {
    // Récupérer le code de la touche appuyée
    var codeTouche = event.keyCode || event.which;

    if (codeTouche != 16)
    {
        if ((codeTouche >= 48 && codeTouche <= 57) || // Chiffres (0-9)
            (codeTouche >= 96 && codeTouche <= 105) || // Pavé numerique (0-9)
            (codeTouche >= 65 && codeTouche <= 70) || // Lettres majuscules (a-f)
            codeTouche === 8 || // Touche "Retour arrière" (Backspace)
            codeTouche === 46) { // Touche "Supprimer" (Delete)
        
            if (codeTouche === 8)
            {
                if ((count-2) == 0) count = 7;
                $("#code_input_"+(count-2)).focus();
            }
            else
            {
                var lastChar = input.value.slice(-1);
                var regex = /^[a-fA-F0-9]$/;
                if (!regex.test(lastChar)) {
                    // Supprimer la dernière touche entrée si elle n'est pas valide
                    input.value = input.value.slice(0, -1);
                }
                else
                {
                    $("#code_input_"+count).focus();   
                }
            }
        }
        else {
            input.value = input.value.slice(0, -1);
            event.preventDefault(); // Empêcher l'action par défaut pour les autres touches
        }
    }
}

function startCountdown(id,interval) 
{
    var x = setInterval(function() 
    {
        var now = new Date().getTime();
        var ecart = (countDownEcart - (now - countDownDate));
        var days = Math.floor(ecart / (1000 * 60 * 60 * 24));
        var hours = Math.floor((ecart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((ecart % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((ecart % (1000 * 60)) / 1000);
        if (ecart > 0) 
        {
          var txtCountdown = null;
          if (days > 0)
          {
              txtCountdown =  String(days).padStart(2, '0') + "j:" + String(hours).padStart(2, '0') + "h:" + String(minutes).padStart(2, '0')  + "m:" + String(seconds).padStart(2, '0') + "s ";
          }
          else
          {
              if (hours > 0)
              {
                txtCountdown = String(hours).padStart(2, '0') + "h:" + String(minutes).padStart(2, '0')  + "m:" + String(seconds).padStart(2, '0') + "s ";
              }
              else
              {
                if (minutes > 0)
                {
                  txtCountdown = String(minutes).padStart(2, '0')  + "m:" + String(seconds).padStart(2, '0') + "s ";
                }
                else
                {
                  txtCountdown = String(seconds).padStart(2, '0') + "s ";
                }
              }
          }
        }
        else
        {
          clearInterval(x);
          txtCountdown = "00s";
        }
        document.getElementById(id).innerHTML = txtCountdown;
    }, interval);
}

function redirectAfterAction(data)
{
    setAlert(data.redirection.msg,data.redirection.type);
    window.location.href = data.redirection.url;
}

function loginUser()
{   
    let dataPost = {
        login: $('#login').val(),
        password: $('#password').val(),
        remember: $('#remember').is(':checked')
    };
    $axios_getpost('signin.php',dataPost,null,redirectAfterAction,null);
}

function askResetPassword()
{   
    let dataPost = {
        login: $('#login').val(),
    };
    $axios_getpost('askresetpassword.php',dataPost,null,redirectAfterAction,null);
}

function createUser()
{   
    let dataPost = {
        user_type: select_user_type,
        user_lastname:  $('#user_lastname').val(),
        user_name:  $('#user_name').val(),
        user_assoc_name: $('#user_assoc_name').val(),
        user_address:  $('#user_address').val(),
        user_telephone:  $('#user_telephone').val(),
        user_password: $('#user_password_0').val(),
        user_email: $('#user_email').val()
    };

    $axios_getpost('signup.php',dataPost,null,redirectAfterAction,null);
}

function checkCode()
{
    let dataPost = {
        code1: $('#code_input_1').val(),
        code2: $('#code_input_2').val(),
        code3: $('#code_input_3').val(),
        code4: $('#code_input_4').val(),
        code5: $('#code_input_5').val()
    };
    $axios_getpost( window.location.pathname.slice(1), dataPost, null, redirectAfterAction, null);
}

function resetPassword()
{
    let dataPost = {
        password: $('#user_password_0').val(),
        repeat_password: $('#user_password_1').val()
    };
    $axios_getpost(window.location.pathname.slice(1),dataPost,null,redirectAfterAction,null);
}