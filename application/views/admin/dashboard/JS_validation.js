
/* Validation for form dashboard change pass */
function changepassVali()
{
    var txtPass = document.getElementById("inputpass");
    var filtertxtPass = document.getElementById("inputpass");
    var txtPass1 = document.getElementById("inputpass1");
    var filtertxtPass1 = document.getElementById("inputpass1");
    var txtPass2 = document.getElementById("inputpass2");
    var filtertxtPass2 = document.getElementById("inputpass2");

    return (emptyValidation(txtPass, 'inputpass_err') ?
            checkPassWordVali(filtertxtPass, 'inputpass_err') ?
            emptyValidation(txtPass1, 'inputpass1_err') ?
            checkPassWordVali(filtertxtPass1, 'inputpass1_err') ?
            emptyValidation(txtPass2, 'inputpass2_err') ?
            checkPassWordVali(filtertxtPass2, 'inputpass2_err') ?
            true : false : false : false : false : false : false);
}

/* Validation for form edit Profile*/
function editProfilevali()
{
    var txtGameName = document.getElementById("txtadmin_name");
    var filtertxtGameName = document.getElementById("txtadmin_name");
    var txtUname = document.getElementById("txtadUname");
    var filtertxtUname = document.getElementById("txtadUname");
    var txtipEmail = document.getElementById("txtademail");
    var filtertxtipEmail = document.getElementById("txtademail");
    
    return (emptyValidation(txtGameName, 'txtadmin_name_err') ?
            alphaNumeric(filtertxtGameName, 'txtadmin_name_err') ?
            emptyValidation(txtUname, 'txtadUname_err') ?
            alphaNumeric(filtertxtUname, 'txtadUname_err') ?
            emptyValidation(txtipEmail, 'txtademail_err') ?
            checkEmailVali(filtertxtipEmail, 'txtademail_err') ?
            true : false : false : false : false : false : false);
}


/* Check Empty text fields. */

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

/* Check 4 radio  text fields. */
function redioOnOff4(a, msgBox) {
    if (a.checked === false) {
        document.getElementById(msgBox).innerHTML = 'Please select Option';
        return false;
    } else {
        document.getElementById(msgBox).innerHTML = '';
        return true;
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
    var v1 = document.getElementById("inputpass1");
    var v2 = document.getElementById("remove3");
    var v3 = document.getElementById("remove4");

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

function typeCast3() {
    var v1 = document.getElementById("inputpass2");
    var v2 = document.getElementById("remove5");
    var v3 = document.getElementById("remove6");

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


/*Check all AlphaMumeric with space on submit.*/
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
function checkEmailVali(txtfld , msgBox){
var letters = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
   if(txtfld.value.match(letters)){
       document.getElementById(msgBox).innerHTML = '';
   return true;
   }else{
        document.getElementById(msgBox).innerHTML = 'Must enter valid email address';
       txtfld.focus();
       return false;    
   }
}

/*Check password on submit.*/
function checkPassWordVali(txtfld , msgBox){
var letters = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,}$/;
   if(txtfld.value.match(letters)){
       document.getElementById(msgBox).innerHTML = '';
   return true;
   }else{
        document.getElementById(msgBox).innerHTML = 'Enter 1number,upper and lowercase letter and min 4 characters.';
       txtfld.focus();
       return false;    
   }
}

function CheckTags(txtfld , msgBox){
var reg =/<(.|\n)*?>/g;
    var value=txtfld.value;
if (reg.test(value) == false) {
     document.getElementById(msgBox).innerHTML = '';
    return true;
    }
    document.getElementById(msgBox).innerHTML ='do not allow HTMLTAGS';
     txtfld.focus();
     return false;    
}