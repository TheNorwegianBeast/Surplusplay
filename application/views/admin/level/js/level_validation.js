/* Validation for add level */
function addLevel()
{
    var addLevel=document.getElementById("game_level");
    var addLevelName=document.getElementById("level-name");
    var gradeYes=document.getElementById("radio_grade_on");
    var gradeNo=document.getElementById("radio_grade_off");
    var resultYes=document.getElementById("radio_result_on");
    var resultNo=document.getElementById("radio_result_off");
    var attendanceYes=document.getElementById("radio-attend-on");
    var attendanceNo=document.getElementById("radio-attend-off");
    var certificateYes=document.getElementById("radio_certificate_on");
    var certificateNo=document.getElementById("radio_certificate_off");
    var diplomaYes=document.getElementById("radio_diploma_on");
    var diplomaNo=document.getElementById("radio_diploma_off");

    return (emptyValidation(addLevel , 'add_game_err')? 
            emptyValidation(addLevelName , 'level_name_err')?
            alphaNumeric(addLevelName , 'level_name_err')?
            CheckTags(addLevelName , 'level_name_err')?
            radioOnOff(gradeYes,gradeNo,'radio_grade_err')?
            radioOnOff(resultYes,resultNo,'radio_result_err')?
            radioOnOff(attendanceYes,attendanceNo,'radio_attend_err')?
            radioOnOff(certificateYes,certificateNo,'radio_certificate_err')?
            radioOnOff(diplomaYes,diplomaNo,'radio_diploma_err')?
            
            true:false:false:false:false:false:false:false:false:false);
}


/* Validation for Edit level */
function editLevel()
{
    var editLevel=document.getElementById("txt_level");
    var gradeYes=document.getElementById("radio-grade-on");
    var gradeNo=document.getElementById("radio-grade-off");
    var resultYes=document.getElementById("radio-resulton");
    var resultNo=document.getElementById("radio-resultoff");
    var attendanceYes=document.getElementById("radio-attendance-on");
    var attendanceNo=document.getElementById("radio-attendance-off");
    var certificateYes=document.getElementById("radio-certificate-on");
    var certificateNo=document.getElementById("radio-certificate-off");
    var diplomaYes=document.getElementById("radio-diploma-on");
    var diplomaNo=document.getElementById("radio-diploma-off");
    
    return (emptyValidation(editLevel , 'edit_level_err')? 
            alphaNumeric(editLevel , 'edit_level_err')?
            CheckTags(editLevel , 'edit_level_err')?
            radioOnOff(gradeYes,gradeNo,'radio_grade_err')?
            radioOnOff(resultYes,resultNo,'radio_result_err')?
            radioOnOff(attendanceYes,attendanceNo,'radio_attendance_err')?
            radioOnOff(certificateYes,certificateNo,'radio_certificate_err')?
            radioOnOff(diplomaYes,diplomaNo,'radio_diploma_err')?
            
            true:false:false:false:false:false:false:false:false);
}


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


/* Check 2 Radio text fields. */

   function radioOnOff(a,b,msgBox){
   if(a.checked === false && b.checked === false){
       document.getElementById(msgBox).innerHTML = 'Please select Option.';
       return false;
   }else{
       document.getElementById(msgBox).innerHTML = '';
       return true;
   }
}



/*Check all Alphabets on submit.*/
function allLetter(txtfld , msgBox){
var letters = /^[A-Za-z ]+$/;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;    
    }
}


/*Check AllNumbers On Submit .*/
function allNumbers(txtfld , msgBox){
    var letters = /^[0-9]+$/;

    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
        document.getElementById(msgBox).innerHTML = 'Must have Numbers only';
        txtfld.focus();
        return false;    
    }
}


/*Check all Alphabets without space on submit.*/
function allLetterNoSpace(txtfld , msgBox){
var letters = /^[A-Za-z]+$/;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;    
    }
}


/*Check all AlphaMumeric with space on submit.*/
function alphaNumeric(txtfld , msgBox){
var letters = /^([a-z0-9 ])+$/i;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
        txtfld.focus();
        return false;    
    }
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

/*Check all AlphaMumeric with plus on submit.*/
function alphaNumericPlus(txtfld , msgBox){
var letters = /^([a-z0-9+])+$/i;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphabet characters only';
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
