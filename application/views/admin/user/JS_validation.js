
/* Validation for form Add level */
function addUserVali()
{
    var txtGame = document.getElementById("select_game");
    var txtName = document.getElementById("txt_login_name");
    var userident = document.getElementById("txt_userident");
    var FirstName = document.getElementById("inputfirstname");
    var LastName = document.getElementById("inputLastname");
    var Email = document.getElementById("txt_email");
    var password = document.getElementById("txt_password");
    var chk4 = document.getElementById("test4");
    var chk5 = document.getElementById("test5");

    return (emptyValidation(txtGame, 'err_game_id') ?
            emptyValidation(txtName, 'err_name') ?
            alphaNumericNoSpace(txtName, 'err_name') ?
            emptyValidation(userident, 'userident_err') ?
            alphaNumericNoSpace(userident, 'userident_err') ?
            emptyValidation(FirstName, 'fname_err') ?
            allLetter(FirstName, 'fname_err') ?
            emptyValidation(LastName, 'lname_err') ?
            allLetter(LastName, 'lname_err') ?
            emptyValidation(Email, 'email_span') ?
            checkEmailVali(Email, 'email_span') ?
            emptyValidation(password, 'pass_err') ?
            checkPassWordVali(password, 'pass_err') ?
            CheckBoxOnOff(chk4, chk5, 'checkbx_err') ?
            true : false : false : false : false : false : false : false : false : false : false : false : false : false : false);
}

/* Validation for form edit User */
function editUservali()
{
    var frstName = document.getElementById("inputFirstName");
    var LstName = document.getElementById("inputLastName");
    var ipEmail = document.getElementById("txt_email");

    return (emptyValidation(frstName, 'fname_err') ?
            allLetter(frstName, 'fname_err') ?
            emptyValidation(LstName, 'lname_err') ?
            allLetter(LstName, 'lname_err') ?
            emptyValidation(ipEmail, 'email_span') ?
            checkEmailVali(ipEmail, 'email_span') ?
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
function redioOnOff2(a, b, msgBox) {
    if (a.checked === false && b.checked === false) {
        document.getElementById(msgBox).innerHTML = 'Please select Option';
        return false;
    } else {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    }
}

/* javascript regex functions starts */

/*Check all Alphabets on submit.*/
function allLetter(txtfld, msgBox) {
    var letters = /^[A-Za-z ]+$/;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;
    }
}


/*Check AllNumbers On Submit .*/
function allNumbers(txtfld, msgBox) {
    var letters = /^[0-9]+$/;

    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have Numbers only';
        txtfld.focus();
        return false;
    }
}


/*Check all Alphabets without space on submit.*/
function allLetterNoSpace(txtfld, msgBox) {
    var letters = /^[A-Za-z]+$/;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;
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

/*Check all AlphaMumeric without space on submit.*/
function alphaNumericNoSpace(txtfld, msgBox) {
    var letters = /^([a-z0-9])+$/i;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have alphanumeric characters only';
        txtfld.focus();
        return false;
    }
}

/*Check all AlphaMumeric with plus on submit for grades.*/
function alphaNumericPlus(txtfld, msgBox) {
    var letters = /^([a-z0-9+])+$/i;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;
    }
}


function CheckTags(txtfld, msgBox) {
    var reg = /<(.|\n)*?>/g;
    var value = txtfld.value;
    if (reg.test(value) == false) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    }
    document.getElementById(msgBox).innerHTML = 'do not allow HTMLTAGS';
    txtfld.focus();
    return false;
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

/*Check password on submit.*/
function checkPassWordVali(txtfld, msgBox) {
    var letters = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,}$/;
    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Enter 1number, 1upper, lowercase letter,1special character and min 4 or more characters.';
        txtfld.focus();
        return false;
    }
}

//=============================================================================
//Check 2 check box fields.
//=============================================================================
function CheckBoxOnOff(a, b, msgBox) {
    if (a.checked === false && b.checked === false) {
        document.getElementById(msgBox).innerHTML = 'Please select Option';
        return false;
    } else {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    }
} 