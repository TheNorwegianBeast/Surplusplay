const inputs = document.querySelectorAll(".input");


function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value === "") {
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
})


/* Validation for form index */
function indexVali()
{
    var txtuserinput1 = document.getElementById("userinput1");
    var filtertxtuserinput1 = document.getElementById("userinput1");
    var userpass1 = document.getElementById("inputpass");
    var filteruserpass1 = document.getElementById("inputpass");

    return (emptyValidation(txtuserinput1, 'userinput_err') ?
            alphaNumeric(filtertxtuserinput1, 'userinput_err') ?
            emptyValidation(userpass1, 'inputpass_error') ?
            checkPassWordVali(filteruserpass1, 'inputpass_error') ?
            true : false : false : false : false);
}

function forgotpassvali()
{
    var txtuseremail1 = document.getElementById("txt_email");
    var filtertxtuseremail1 = document.getElementById("txt_email");

    return (emptyValidation(txtuseremail1, 'txt_email_err') ?
            checkEmailVali(filtertxtuseremail1, 'txt_email_err') ?
            true : false : false);
}

/* Validation for form verify otp and reset pass */
function verifyotpvali()
{
    var txtotpinput1 = document.getElementById("txt_otp");
    var filtertxtotpinput1 = document.getElementById("txt_otp");
    var newuserpass1 = document.getElementById("inputpass");
    var filternewuserpass1 = document.getElementById("inputpass");
    var cnfrmuserpass1 = document.getElementById("inputpass2");
    var filtercnfrmuserpass1 = document.getElementById("inputpass2");
    
    return (emptyValidation(txtotpinput1, 'errorspan') ?
            alphaNumeric(filtertxtotpinput1, 'errorspan') ?
            emptyValidation(newuserpass1, 'inp_pass_err') ?
            checkPassWordVali(filternewuserpass1, 'inp_pass_err') ?
            emptyValidation(cnfrmuserpass1, 'inputpass2_error') ?
            checkPassWordVali(filtercnfrmuserpass1, 'inputpass2_error') ?
            true : false : false : false : false : false : false);
}

function emptyValidation(control, msgBox) {

    var control_len = control.value.length;
    if (control_len === 0) {
        document.getElementById(msgBox).innerHTML = 'This is required field';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}

function alphaNumeric(txtfld, msgBox) {
    var letters = /^([a-z0-9 ])+$/i;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;
    }
}

/*Check all Alphabets on submit.*/
function checkEmailVali(txtfld, msgBox) {
    var letters = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must enter valid email address';
        txtfld.focus();
        return false;
    }
}

function checkPassWordVali(txtfld , msgBox){
var letters = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,}$/;
   if(txtfld.value.match(letters)){
       document.getElementById(msgBox).innerHTML = '';
   return true;
   }else{
        document.getElementById(msgBox).innerHTML = 'Enter 1 upper, 1 number, lowercase, 1 special character and min 4 or more characters.';
       txtfld.focus();
       return false;    
   }
}

function typeCast() {
    var v1 = document.getElementById("inputpass");
    var v2 = document.getElementById("remove1");
    var v3 = document.getElementById("remove2");

    if (v1.type === 'password') {
        v1.type = "text";
        v2.style.display = "block";
        v3.style.display = "none";
    } else {
        v1.type = "password";
        v2.style.display = "none";
        v3.style.display = "block";
    }
}

function typeCast2() {
    var v4 = document.getElementById("inputpass2");
    var v5 = document.getElementById("remove3");
    var v6 = document.getElementById("remove4");

    if (v4.type === 'password') {
        v4.type = "text";
        v5.style.display = "block";
        v6.style.display = "none";
    } else {
        v4.type = "password";
        v5.style.display = "none";
        v6.style.display = "block";
    }
}

var box = document.getElementById("alert_box");
setTimeout(
        function () {
            box.style.display = 'none';
        }, 3500
        );

var box2 = document.getElementById("err_parant");
setTimeout(
        function () {
            box2.style.display = 'none';
        }, 3500
        );