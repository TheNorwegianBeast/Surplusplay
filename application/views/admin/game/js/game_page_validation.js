/* Validation for form Edit game */
function editGame()
{
    var editGame=document.getElementById("txt_game_name");
    var suscribeName=document.getElementById("select_subsc");
   
   
    return (emptyValidation(editGame , 'edit_game_err')? 
            alphaNumeric(editGame , 'edit_game_err')?
            CheckTags(editGame , 'edit_game_err')?
            emptyValidation(suscribeName , 'game_subs_err')?
            CheckTags(suscribeName , 'game_subs_err')?

            true:false:false:false:false:false);
}


/* Validation for form Edit game */
function editGrade()
{
    var editFromPercent=document.getElementById("txt_from_percent");
    var editToPercent=document.getElementById("to_percentage");
    var editGrade=document.getElementById("edit_grade");
    var gradeDesc=document.getElementById("txt_time");
    var participateOn=document.getElementById("radio_res_on");
    var participateOff=document.getElementById("radio_res_off");

    return (emptyValidation(editFromPercent , 'percentage_err')? 
            percentage(editFromPercent , 'percentage_err')?
            CheckTags(editFromPercent , 'percentage_err')?
            emptyValidation(editToPercent , 'to_percentage_err')?
            percentage(editToPercent , 'to_percentage_err')?
            CheckTags(editToPercent , 'to_percentage_err')?
            emptyValidation(editGrade , 'edit_grade_err')?
            alphaNumericPlusSpace(editGrade , 'edit_grade_err')?
            CheckTags(editGrade , 'edit_grade_err')?
            emptyValidation(gradeDesc , 'txt_time_err')?
            CheckTags(gradeDesc , 'txt_time_err')?
            emptyValidation(participateOn,participateOff , 'participate_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false);
}

/* Validation for form Edit game */
function editKnowledgeGrade()
{   
    var editLevelImage=document.getElementById("inp_level_img");
    var editQuizImage=document.getElementById("inp_quiz_img");
    var editFromPercent=document.getElementById("txt_from_percent");
    var editToPercent=document.getElementById("to_percentage");
    var knowGrade=document.getElementById("know_grade");
    var gradeDesc=document.getElementById("txt_time");
    var participateOn=document.getElementById("radio_res_on");
    var participateOff=document.getElementById("radio_res_off");

    return (emptyValidation(editLevelImage , 'level_img_err')?
            emptyValidation(editQuizImage , 'quiz_img_err')?
            emptyValidation(editFromPercent , 'from_percentage_err')? 
            allNumbers(editFromPercent , 'from_percentage_err')?
            percentage(editFromPercent , 'from_percentage_err')?
            CheckTags(editFromPercent , 'from_percentage_err')?
            emptyValidation(editToPercent , 'to_percentage_err')?
            percentage(editToPercent , 'to_percentage_err')?
            CheckTags(editToPercent , 'to_percentage_err')?
            emptyValidation(knowGrade , 'know_grade_err')?
            alphaNumericPlusSpace(knowGrade , 'know_grade_err')?
            CheckTags(knowGrade , 'know_grade_err')?
            emptyValidation(gradeDesc , 'txt_time_err')?
            CheckTags(gradeDesc , 'txt_time_err')?
            emptyValidation(participateOn,participateOff , 'participate_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
}

/* Validation for manage Grade */
function manageGrade()
{
    var addFromPercent=document.getElementById("txtpercent");
    var addToPercent=document.getElementById("to_percent");
    var addGrade=document.getElementById("add_grade");
    var badgeImage=document.getElementById("badge_img");
    var congratsImage=document.getElementById("congrat_img");
    var gradeDesc=document.getElementById("add_desc");
    var participationOn=document.getElementById("radio_grade_on");
    var participationOff=document.getElementById("radio_grade_off");
    

    return (emptyValidation(addFromPercent , 'from_percent_err')? 
            percentage(addFromPercent , 'from_percent_err')?
            CheckTags(addFromPercent , 'from_percent_err')?
            emptyValidation(addToPercent , 'to_percent_err')?
            percentage(addToPercent , 'to_percent_err')?
            CheckTags(addToPercent , 'to_percent_err')?
            emptyValidation(addGrade , 'add_grade_err')?
            alphaNumericPlusSpace(addGrade , 'add_grade_err')?
            CheckTags(addGrade , 'add_grade_err')?
            emptyValidation(badgeImage , 'badge_img_err')?
            emptyValidation(congratsImage , 'congrats_img_err')?
            emptyValidation(gradeDesc , 'desc_err')?
            CheckTags(gradeDesc , 'desc_err')?
            radioOnOff(participationOn ,participationOff, 'participate_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
}

/* Validation for form add knowldge grade */
function manageKnowledgeGrade()
{
    var addFromPercent=document.getElementById("txtpercent");
    var addToPercent=document.getElementById("to_percent");
    var knowImage=document.getElementById("know-img");
    var quizImage=document.getElementById("quiz-img");
    var addGrade=document.getElementById("add-grade");
    var gradeDesc=document.getElementById("add_desc");
    var participateOn=document.getElementById("radio_grade_on");
    var participateOff=document.getElementById("radio_grade_off");

    return (emptyValidation(addFromPercent , 'from_percent_err')?
            percentage(addFromPercent , 'from_percent_err')?
            CheckTags(addFromPercent , 'from_percent_err')?
            emptyValidation(addToPercent , 'to_percent_err')?
            percentage(addToPercent , 'to_percent_err')?
            CheckTags(addToPercent , 'to_percent_err')?
            emptyValidation(knowImage , 'know-img_err')?
            emptyValidation(quizImage , 'quiz-img-err')?
            emptyValidation(addGrade , 'add-grade_err')?
            alphaNumericPlusSpace(addGrade , 'add-grade_err')?
            CheckTags(addGrade , 'add-grade_err')?
            emptyValidation(gradeDesc , 'add_desc_err')?
            CheckTags(gradeDesc , 'add_desc_err')?
            radioOnOff(participateOn,participateOff , 'participate_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
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

/*Check Percentage range between 0 to 100.*/
function percentage(txtfld , msgBox){
    var letters = /^(\d\d?(\.\d\d?)?|100(\.00?)?)$/;

    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
        document.getElementById(msgBox).innerHTML = 'Percentage must have range 0 to 100.';
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

/*Check all AlphaMumeric with plus and space on submit.*/
function alphaNumericPlusSpace(txtfld , msgBox){
var letters = /^([a-z0-9+ ])+$/i;
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
    document.getElementById(msgBox).innerHTML ='HTML tags are not allowed.';
     txtfld.focus();
     return false;    

}
