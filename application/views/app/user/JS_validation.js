
/* Validation for varify password page */
function varifyPassVali()
{
    var txtOtp=document.getElementById("txt_otp");
    var txtPassword=document.getElementById("password");
    var confirmPassword=document.getElementById("confirm_password");
   
    return (emptyValidation(txtOtp , 'err_otp')? 
            alphaNumericNoSpace(txtOtp , 'err_otp')? 
            CheckTags(txtOtp , 'err_otp')? 
            emptyValidation(txtPassword , 'err_password')?
            checkPassWordVali(txtPassword , 'err_password')?
            CheckTags(txtPassword , 'err_password')?
            emptyValidation(confirmPassword , 'err_confirm_password')? 
            checkPassWordVali(confirmPassword , 'err_confirm_password')? 
            CheckTags(confirmPassword , 'err_confirm_password')? 
            true:false:false:false:false:false:false:false:false:false);
}


/* Check Empty text fields. */

function emptyValidation(control, msgBox){
   
    var control_len = control.value.length;
    if (control_len === 0 ) {
        document.getElementById(msgBox).innerHTML = 'This is required field';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}



/*Check all AlphaMumeric without space on submit.*/
function alphaNumericNoSpace(txtfld , msgBox){ 
var letters = /^([a-z0-9])+$/i;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;    
    }
}


/*Check all Alphabets on submit.*/
function checkPassWordVali(txtfld , msgBox){
var letters = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,}$/;
   if(txtfld.value.match(letters)){
       document.getElementById(msgBox).innerHTML = '';
   return true;
   }else{
        document.getElementById(msgBox).innerHTML = 'Enter 1num, 1upper, 1lower and min 4 or more characters.';
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

