//============================================================================================
// Validations for Add Course form.
//============================================================================================
function addCrsVal()
{
    var crstitle=document.getElementById("txttitle");
    var crsdt1 = document.getElementById("txtfromdate");
    var crsdt2 = document.getElementById("txttodate");
    var grdRon = document.getElementById("radiogradeOn");
    var grdRoff = document.getElementById("radiogradeOff");
    var resRon = document.getElementById("radioresultOn");
    var resRoff = document.getElementById("radioresultOff");
    var attRon = document.getElementById("radioattendanceOn");
    var attRoff = document.getElementById("radioattendanceOff");
    var certRon = document.getElementById("radiocertificateOn");
    var certRoff = document.getElementById("radiocertificateOff");
    var dipRon = document.getElementById("radiodiplomaOn");
    var dipRoff = document.getElementById("radiodiplomaOff");


    if(emptyValidation(crstitle , 'titleError')){                      
                    if(emptyValidation(crsdt1, 'dtError1')){
                        if(emptyValidation(crsdt2, 'dtError2')){
                            if(redioOnOff(grdRon,grdRoff,'grdRerr')){
                                if(redioOnOff(resRon,resRoff,'resRerr')){
                                   if(redioOnOff(attRon,attRoff,'attRerr')){
                                      if(redioOnOff(certRon,certRoff,'certRerr')){
                                         if(redioOnOff(dipRon,dipRoff,'dipRerr')){
//                                                   alert("You have successfully tested");
                                                   return true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }   
    return false;
     
}
//==============================================================================================
//Validations for Add courseQz form.
//=============================================================================================

function addCrsQzVal()
{

    var file = document.getElementById("fileImg");
    var color = document.getElementById("txtcolor").value;
    var crsStep = document.getElementById("txtstep");
    var totQs = document.getElementById("txttotquestion");
    var totCrAns = document.getElementById("txtcorrectans");
    var timeLmt = document.getElementById("txttime");
    var frDt = document.getElementById("txtfromdate");
    var toDt = document.getElementById("txttodate");
    var radon = document.getElementById("radioresultOn");
    var radoff = document.getElementById("radioresultOff");

    if(emptyValidation(file, 'fileerr')){
    //                   if(colorVal(color, 'clrerr')){
                            if(emptyValidation(crsStep,'steperr')){
                                if(allNumbers(totQs,'totQerr')){
                                   if(allNumbers(totCrAns,'totCrAnserr')){
                                      if(allNumbers(timeLmt,'timeerr')){
    //                                     if(emptyValidation(frDt,'frDtErr')){
    //                                         if(emptyValidation(toDt,'toDtErr')){
                                                 if(redioOnOff(radon,radoff,'radOffErr')){
//                                                        alert("Successfully tested");
                                                       return true;
                                                    }
                                                }
          //                                  }
        //                                }
                                    }
                                }
                            }
    //                    }
                    }
    return false;
}

//==============================================================================================
//Validations for Add Grade form.
//==============================================================================================

function addGradVal()
{
    var per = document.getElementById("txtpercent");
    var badgeImg = document.getElementById("filebadge");

    if(emptyValidation(per, 'perErr')){
      
    //                       if(allLetter(grade, 'grdErr')){
                            if(emptyValidation(badgeImg,'fileErr')){
                            
                                   // alert("Successfully tested");
                                   return true;
                                   
                             
                            }
    //                      }
   
                    }
    return false;
}

//==============================================================================================
//Validations for Add Knowledge form.
//===============================================================================================

function addKnowVal()
{
    var select = document.getElementById("select");
    var file = document.getElementById("fileknow");
    

    if(emptyValidation(select, 'selectErr')){
                       if(emptyValidation(file, 'fileErr')){
                           //alert("Successfully tested");
                           return true;
                        }
                    }
    return false;
}

//=======================================================================
//Add Quetions Validation
//=======================================================================
function addQueVal()
{
   
    var que = document.getElementById("txtqtn");
    var opAtxt = document.getElementById("txtpOA");
    var opBtxt = document.getElementById("txtpOB");
    var opCtxt = document.getElementById("txtpOC");
    var opDtxt = document.getElementById("txtpOD");
    var OpArad = document.getElementById("radioansA");
    var OpBrad = document.getElementById("radioansB");
    var OpCrad = document.getElementById("radioansC");
    var OpDrad = document.getElementById("radioansD");
    var desc = document.getElementById("txtdesc");
    
    if(emptyValidation(que, 'queError')){
        if(emptyValidation(opAtxt, 'optionAError')){
            if(emptyValidation(opBtxt, 'optionBError')){
                if(emptyValidation(opCtxt, 'optionCError')){
                    if(emptyValidation(opDtxt, 'optionDError')){
                        if(redioOnOff4(OpArad,OpBrad,OpCrad,OpDrad,'RadError')){
                            if(emptyValidation(desc, 'descError')){
                                            //alert("Successfully tested");
                                            return false;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
   return false;
}

//===================================================================================
//Add Group Table Validation
//===================================================================================
function addGrpTblVal()
{
    var txtSubid = document.getElementById("txtsubscId");
    var txtGrpid = document.getElementById("txtgroupId");
    var txtNm = document.getElementById("txtName");
    

    if(emptyValidation(txtSubid, 'txtSubIdErr')){
                       if(emptyValidation(txtGrpid, 'txtGrpIdErr')){
                            if(emptyValidation(txtNm, 'txtNmErr')){
                               //alert("Successfully tested");
                                return true;
                            }
                        }
                    }
    return false;
}

//==============================================================================================
//Validations for LogIn form.
//=============================================================================================
function logInVal()
{
    var uName = document.getElementById("username");
    var Pw = document.getElementById("pass");
    

    if(emptyValidation(uName, 'uNameError')){
                       if(emptyValidation(Pw, 'passError')){
                           //alert("Successfully tested");
                           return true;
                        }
                    }
    return false;
}

//==============================================================================================
//Validations for LogIn Name.
//=============================================================================================
function LogNameVal()
{
    var uName = document.getElementById("txtloginname");
    

    if(emptyValidation(uName, 'logNmErr')){
                          //alert("Successfully tested");
                          return true;
                    }
    return false;
}
//=========================================================================
// Validations for Add Course form
//=========================================================================
function mappVal()
{
    var mapNm=document.getElementById("txtmappingname");
    var srcData = document.getElementById("txtsourcedata");
    var impFLoc = document.getElementById("txtimportfileLoc");
    var backUp = document.getElementById("txtbackupLoc");
    var dataForm = document.getElementById("txtdataformat");
    var impTbl = document.getElementById("txtimporttable");
    var strdt = document.getElementById("txtstart");
    var strDay = document.getElementById("select_StartDay");
    var strTime = document.getElementById("txtstarttime");
    var endDay = document.getElementById("select_EndDay");
    var endTime = document.getElementById("txtendtime");
    var endDt = document.getElementById("txtend");
    var interval = document.getElementById("txtinterval");


    if(emptyValidation(mapNm , 'mapNmError')){                      
                  if(emptyValidation(srcData, 'srcDataError')){
                        if(emptyValidation(impFLoc, 'impFileError')){
                            if(emptyValidation(backUp, 'bckupFError')){
                                if(emptyValidation(dataForm, 'dataForError')){
                                    if(emptyValidation(impTbl, 'impTblError')){
                                        if(emptyValidation(strdt, 'startDtError')){
                                            if(emptyValidation(strDay, 'strDyError')){
                                                if(emptyValidation(strTime, 'strTmError')){
                                                    if(emptyValidation(endDay, 'endDyError')){
                                                        if(emptyValidation(endTime, 'endTmError')){
                                                            if(emptyValidation(endDt, 'endDtError')){
                                                                if(emptyValidation(interval, 'intervalError')){
                                                                  //alert("Successfully tested");
                                                                   return true;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            
                        }
                    }
                }   
    return false;
     
}


//=============================================================================
//Check all Alphabets on submit.
//=============================================================================
function allLetter(txtfld , msgBox){ 
var letters = /^[A-Za-z ]+$/;

    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
         document.getElementById(msgBox).innerHTML = '<font style="color: red;">Must have alphabet characters only</font>';
        txtfld.focus();
        return false;    
    }
}
//=============================================================================
//Check AllNumbers On Submit .
//=============================================================================
function allNumbers(txtfld , msgBox){ 
    var letters = /^[0-9]+$/;

    if(txtfld.value.match(letters)){
        document.getElementById(msgBox).innerHTML = '';
    return true;
    }else{
        document.getElementById(msgBox).innerHTML = '<font style="color: red;">Must have Numbers only</font>';
        txtfld.focus();
        return false;    
    }
}

//=============================================================================
//Check Empty text fields.
//=============================================================================

function emptyValidation(control, msgBox){
   
    var control_len = control.value.length;
    if (control_len === 0 ) {
        document.getElementById(msgBox).innerHTML = '<font style="color: red;">This is required field.</font><br>';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}  

//=============================================================================
//Check empty color.
//=============================================================================
function colorVal(color,msgBox){
            if(color =="#000000"){
                document.getElementById(msgBox).innerHTML = '<font style="color: red;"> This is required field</font><br>';
                 return false;
                }else{
                    document.getElementById(msgBox).innerHTML = '';
                    return true;
           }
}

//=============================================================================
//Check 2 Radio text fields.
//=============================================================================
    function redioOnOff(a,b,msgBox){
    if(a.checked === false && b.checked === false){
        document.getElementById(msgBox).innerHTML = 'Please select Option';
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
//=============================================================================
//Check Alphabets text fields.
//=============================================================================
function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)||(charCode ==32))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        } 
//=================================================================================
//Check Numeric text fields.
//=================================================================================
 function onlyNumbers(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 46 && charCode < 58))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        } 
//=================================================================================
//Check AlphaNumeric text fields.
//=================================================================================

 function onlyAlphaNum(e, t,msgBox) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)||(charCode ==32))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
        
        
//=================================================================================
//Check AlpaNumSpcChar text fields.
//=================================================================================

 function onlyAlpaNumSpcChar(e, t,msgBox) {
           try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)||(charCode ==32))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        } 

//======================================================================================================================================================
//======================================================================================================================================================


//=============================================================================
//Check Alphabets and "+" text fields.
//=============================================================================
function onlyAlphaAndPlus(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)||(charCode ==32)||(charCode ==107))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        } 