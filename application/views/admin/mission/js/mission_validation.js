/* Validation for form Add budget */
function addBudget()
{
    var addBugetUser=document.getElementById("user_name");
    var budgetYear=document.getElementById("txt_year");
    var daysComplete=document.getElementById("txt_day_To_Comp");
    var budgetOn=document.getElementById("txt_budget_type");
    var carRegistration=document.getElementById("txt_quan_reg");
    var testdriveQuantity=document.getElementById("txt_quan_drive");

    return (emptyValidation(addBugetUser , 'budget_user-err')? 
            alphaNumeric(addBugetUser , 'budget_user-err')?
            CheckTags(addBugetUser , 'budget_user-err')?
            emptyValidation(budgetYear , 'budget_year_err')?
            allNumbers(budgetYear , 'budget_year_err')?
            CheckTags(budgetYear , 'budget_year_err')?
            emptyValidation(daysComplete , 'days_err')? 
            allNumbers(daysComplete , 'days_err')?
            CheckTags(daysComplete , 'days_err')?
            emptyValidation(budgetOn , 'budget_on_err')?
            allLetter(budgetOn , 'budget_on_err')?
            emptyValidation(carRegistration , 'car_quantity_err')?
            allNumbers(carRegistration , 'car_quantity_err')?
            CheckTags(carRegistration , 'car_quantity_err')?
            emptyValidation(testdriveQuantity , 'testdrive_err')?
            allNumbers(testdriveQuantity , 'testdrive_err')?
            CheckTags(testdriveQuantity , 'testdrive_err')?
            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false);

}

/* Validation for form Add knowledge */
function addKnowledge()
{
    var videoSelect=document.getElementById("video_select");
    
    return (emptyValidation(videoSelect , 'video_select_err')? 
    
            true:false);
}


/* Validation for form Add mission */
function addMission()
{
    
    var addGameErr=document.getElementById("game_level");
    var selectLevel=document.getElementById("select_level");
    var cityImage=document.getElementById("city_image");
    var cityName=document.getElementById("city_name");
    var missionStep=document.getElementById("mission_step");
    var totalQuestion=document.getElementById("txt_total_question");
    var correctAns=document.getElementById("txt_correct_answer");
    var timeLimit=document.getElementById("time_limit");
    var participateOn=document.getElementById("result_radio_on");
    var participateOff=document.getElementById("result_radio_off");
   
   
    return (emptyValidation(addGameErr , 'add_game_err')? 
            emptyValidation(selectLevel , 'select_level_err')?
            emptyValidation(cityImage , 'city_img_err')? 
            emptyValidation(cityName , 'city_name_err')?
            allLetter(cityName , 'city_name_err')?
            CheckTags(cityName , 'city_name_err')?
            emptyValidation(missionStep , 'mission_step_err')?
            alphaNumeric(missionStep , 'mission_step_err')?
            CheckTags(missionStep , 'mission_step_err')?
            emptyValidation(totalQuestion , 'total_que_err')?
            allNumbers(totalQuestion , 'total_que_err')?
            CheckTags(totalQuestion , 'total_que_err')?
            emptyValidation(correctAns , 'correct_ans_err')?
            allNumbers(correctAns , 'correct_ans_err')?
            CheckTags(correctAns , 'correct_ans_err')?
            emptyValidation(timeLimit , 'time_limit_err')?
            allNumbers(timeLimit , 'time_limit_err')?
            CheckTags(timeLimit , 'time_limit_err')?
            radioOnOff(participateOn,participateOff , 'result_radio_err')?
            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
}



/* Validation for form Add mission */
function managerQuestion()
{
    var addQuestion=document.getElementById("add_question");
    var firstOption=document.getElementById("option_first");
    var secondOption=document.getElementById("option_second");
    var thirdOption=document.getElementById("option_third");
    var fourthOption=document.getElementById("option_fourth");
    var optionDesc=document.getElementById("option_description");
    var optionA=document.getElementById("radiograde_a");
    var optionB=document.getElementById("radiograde_b");
    var optionC=document.getElementById("radiograde_c");
    var optionD=document.getElementById("radiograde_d");
   
   
    return (emptyValidation(addQuestion , 'add_question_err')? 
            CheckTags(addQuestion , 'add_question_err')?
            emptyValidation(firstOption , 'first_option_err')?
            CheckTags(firstOption , 'first_option_err')?
            emptyValidation(secondOption , 'second_option_err')?
            CheckTags(secondOption , 'second_option_err')?
            emptyValidation(thirdOption , 'third_option_err')?
            CheckTags(thirdOption , 'third_option_err')?
            emptyValidation(fourthOption , 'fourth_option_err')?
            CheckTags(fourthOption , 'fourth_option_err')?
            redioOnOff4(optionA,optionB,optionC,optionD , 'select_option_err')?
            emptyValidation(optionDesc , 'option_desc_err')?
            CheckTags(optionDesc , 'option_desc_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false);
}



/* Validation for form Add knowledge */
function editBudget()
{
    var editBudgetYear=document.getElementById("txt_year");
    var editDaysComplete=document.getElementById("txt_day_To_Comp");
    var editBudgetType=document.getElementById("txt_budget_type");
    var editQuantityReg=document.getElementById("txt_quan_reg");
    var editQuantityTest=document.getElementById("txt_quan_drive");
   
   
    return (emptyValidation(editBudgetYear , 'budget_year_err')? 
            allNumbers(editBudgetYear , 'budget_year_err')?
            CheckTags(editBudgetYear , 'budget_year_err')?
            emptyValidation(editDaysComplete , 'day_complete_err')?
            allNumbers(editDaysComplete , 'day_complete_err')?
            CheckTags(editDaysComplete , 'day_complete_err')?
            emptyValidation(editBudgetType , 'budget_type_err')?
            allLetter(editBudgetType , 'budget_type_err')?
            emptyValidation(editQuantityReg , 'quantity_reg_err')?
            allNumbers(editQuantityReg , 'quantity_reg_err')?
            CheckTags(editQuantityReg , 'quantity_reg_err')?
            emptyValidation(editQuantityTest , 'quantity_test_err')?
            allNumbers(editQuantityTest , 'quantity_test_err')?
            CheckTags(editQuantityTest , 'quantity_test_err')?
            
            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
}

/* Validation for form Edit knowledge */
function editKnowledge()
{
    
    var editVideo=document.getElementById("media_file");
    
    return (emptyValidation(editVideo , 'video_edit_err')? 
    
            true:false);
}

/* Validation for form Edit mission */
function editMission()
{
    var editGame=document.getElementById("edit_game_mission");
    var editLevel=document.getElementById("edit_level_mission");
    var cityName=document.getElementById("txt_city");
    var missionStep=document.getElementById("edit_mission_step");
    var totalQuestion=document.getElementById("txt_total_question");
    var correctAnswer=document.getElementById("txt_correct_answer");
    var timeLimit=document.getElementById("txt_time");
   
   
    return (emptyValidation(editGame , 'game_mission_err')?
            emptyValidation(editLevel , 'level_mission_err')?
            emptyValidation(cityName , 'txt_city_err')? 
            allLetter(cityName , 'txt_city_err')?
            CheckTags(cityName , 'txt_city_err')?
            emptyValidation(missionStep , 'mission_step_err')?
            alphaNumeric(missionStep , 'mission_step_err')?
            CheckTags(missionStep , 'mission_step_err')?
            emptyValidation(totalQuestion , 'total_question_err')?
            allNumbers(totalQuestion , 'total_question_err')?
            CheckTags(totalQuestion , 'total_question_err')?
            emptyValidation(correctAnswer , 'correct_answer_err')?
            allNumbers(correctAnswer , 'correct_answer_err')?
            CheckTags(correctAnswer , 'correct_answer_err')?
            emptyValidation(timeLimit , 'txt_time_err')?
            allNumbers(timeLimit , 'txt_time_err')?
            CheckTags(timeLimit , 'txt_time_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false:false);
}

/* Validation for form Edit question */
function editQuestion()
{
    var editQuestion=document.getElementById("edit_question");
    var firstOption=document.getElementById("option_first");
    var secondOption=document.getElementById("option_second");
    var thirdOption=document.getElementById("option_third");
    var fourthOption=document.getElementById("option_fourth");
    var optionA=document.getElementById("option_one");
    var optionB=document.getElementById("option_two");
    var optionC=document.getElementById("option_three");
    var optionD=document.getElementById("option_four");
    var optionDesc=document.getElementById("option_description");
   
   
    return (emptyValidation(editQuestion , 'edit_question_err')? 
            CheckTags(editQuestion , 'edit_question_err')?
            emptyValidation(firstOption , 'first_option_err')?
            CheckTags(firstOption , 'first_option_err')?
            emptyValidation(secondOption , 'second_option_err')?
            CheckTags(secondOption , 'second_option_err')?
            emptyValidation(thirdOption , 'third_option_err')?
            CheckTags(thirdOption , 'third_option_err')?
            emptyValidation(fourthOption , 'fourth_option_err')?
            CheckTags(fourthOption , 'fourth_option_err')?
            redioOnOff4(optionA,optionB,optionC,optionD , 'correct_option_err')?
            emptyValidation(optionDesc , 'option_desc_err')?
            CheckTags(optionDesc , 'option_desc_err')?

            true:false:false:false:false:false:false:false:false:false:false:false:false:false);
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

//=============================================================================
//Check 2 Radio text fields.
//=============================================================================
   function radioOnOff(a,b,msgBox){
   if(a.checked === false && b.checked === false){
       document.getElementById(msgBox).innerHTML = 'Please select Option.';
       return false;
   }else{
       document.getElementById(msgBox).innerHTML = '';
       return true;
   }
}

//=============================================================================
//Check 4 radio  text fields.
//=============================================================================
   function redioOnOff4(a,b,c,d,msgBox){
   if(a.checked === false && b.checked === false && c.checked === false && d.checked === false){
       document.getElementById(msgBox).innerHTML = '<font style="color: red;">&nbsp;&nbsp;Please select Option</font><br>';
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
