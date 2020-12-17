
/* Validation for form Add Interval Notification */
function addIntervalVali()
{
    var txtGame = document.getElementById("selctgameinp");
    var txtSubject = document.getElementById("txt_Subject");
    var txtArea = document.getElementById("txt_areaspace");
    var inpDate = document.getElementById("ip_date");
    var inpNotifyTime = document.getElementById("inpnotify_time");
    var selctIntervaldd = document.getElementById("select_intervaldd");
    var chkTimezone = document.getElementById("timezone_dd");

    return (emptyValidation(txtGame, 'selctgame_err') ?
            emptyValidation(txtSubject, 'subinp_err') ?
            CheckTags(txtSubject, 'subinp_err') ?
            emptyValidation(txtArea, 'areaspace_err') ?
            CheckTags(txtArea, 'areaspace_err') ?
            emptyValidation(inpDate, 'inpdate_err') ?
            emptyValidation(inpNotifyTime, 'notifytime_err') ?
            emptyValidation(selctIntervaldd, 'intervaldd_err') ?
            emptyValidation(chkTimezone, 'timezone_errmsg') ?
            true : false : false : false : false : false : false : false : false : false);
}

/* Validation for form edit Interval notification*/
function editIntervalVali()
{
    var inputSubjctTxt = document.getElementById("inpsubjct_field");
    var txtAreabox = document.getElementById("txtAreabx");
    var notifyDate = document.getElementById("noti_date");
    var notifyTiming = document.getElementById("notif_time");
    var intervalDuration = document.getElementById("interval_setduration");
    var intervalTimez = document.getElementById("timezone_interval");

    return (emptyValidation(inputSubjctTxt, 'inpsubjct_err') ?
            CheckTags(inputSubjctTxt, 'inpsubjct_err') ?
            emptyValidation(txtAreabox, 'txtareabx_err') ?
            CheckTags(txtAreabox, 'txtareabx_err') ?
            emptyValidation(notifyDate, 'notidate_err') ?
            emptyValidation(notifyTiming,   'notif_time_err') ?
            emptyValidation(intervalDuration, 'duration_err') ?
            emptyValidation(intervalTimez, 'tzone_err') ?
            true : false : false : false : false : false : false : false : false);
}

/* Validation for form Add Activity notification*/
function addActivityVali()
{
    var inputselctdd = document.getElementById("seloptdd");
    var txtActivity = document.getElementById("act_type");
    var txtFrank = document.getElementById("txt_from_rank");
    var txtTrank  = document.getElementById("txt_to_rank");
    var sujectEnteredTxt = document.getElementById("txt_actsubject");
    var actMessage = document.getElementById("activity_msgs");

    return (emptyValidation(inputselctdd, 'seloptdd_err') ?
            emptyValidation(txtActivity, 'acttype_err') ?
            emptyValidation(txtFrank, 'txtfrmrnk_err') ?
            emptyValidation(txtTrank, 'txttornk_err') ?
            emptyValidation(sujectEnteredTxt, 'txt_actsubject_err') ?
            alphaNumeric(sujectEnteredTxt, 'txt_actsubject_err') ?
            CheckTags(sujectEnteredTxt, 'txt_actsubject_err') ?
            emptyValidation(actMessage, 'activity_msgs_err') ?
            CheckTags(actMessage, 'activity_msgs_err') ?
            true:false:false:false:false:false:false:false:false:false);
}


/* Validation for form Edit Activity notification*/
function editActivityVali()
{
    var inputOptdd = document.getElementById("slctdd");
    var txtFrmRank = document.getElementById("frm_rank");
    var txtToRank  = document.getElementById("to_rank");
    var sujectEntTxt = document.getElementById("txtentsubject");
    var txtActMsg = document.getElementById("msgareabx");

    return (emptyValidation(inputOptdd, 'slctdd_err') ?
            emptyValidation(txtFrmRank, 'frm_rank_err') ?
            allNumbers(txtFrmRank, 'frm_rank_err') ?
            CheckTags(txtFrmRank, 'frm_rank_err') ?
            emptyValidation(txtToRank, 'to_rank_err') ?
            allNumbers(txtToRank, 'to_rank_err') ?
            CheckTags(txtToRank, 'to_rank_err') ?
            emptyValidation(sujectEntTxt, 'subjcttxt_err') ?
        
            CheckTags(sujectEntTxt, 'subjcttxt_err') ?
            emptyValidation(txtActMsg, 'msgareabx_err') ?
            CheckTags(txtActMsg, 'msgareabx_err') ?
            true:false:false:false:false:false:false:false:false:false:false:false);
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


/* javascript regex functions starts */
/*Check all AlphaMumeric with space on submit.*/
function alphaNumeric(txtfld , msgBox){
var letters = /^([a-z0-9 ])+$/i;
    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = 'Must have alphaumeric characters only';
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
    document.getElementById(msgBox).innerHTML ='Tags are not allowed';
     txtfld.focus();
     return false;    
}
