
/* Validation for form Add Pricelist */
function addPricelistvali()
{
    var txtGame = document.getElementById("select_game");
    var txtProduct = document.getElementById("inp_products");
    var ddBrand = document.getElementById("show_other_brand");
    var otherBrand = document.getElementById("otherbrandhidden");
    var brandType = document.getElementById("brndtype");
    var otherModel = document.getElementById("show_other_model");
    var otherCarModel = document.getElementById("otherCarsModel");
    var modelPrice = document.getElementById("model_price");

    return (emptyValidation(txtGame, 'selctinp_err') ?
            emptyValidation(txtProduct, 'inp_products_err') ?
            alphaNumeric(txtProduct, 'inp_products_err') ?
            emptyValidation(ddBrand, 'show_other_brand_err') ?
            CheckTags(otherBrand, 'otherbr_err') ?
            emptyValidation(brandType, 'brndtype_err') ?
            alphaNumeric(brandType, 'brndtype_err') ?
            emptyValidation(otherModel, 'othermodel_err') ?
            CheckTags(otherCarModel, 'carmodel_err') ?
            emptyValidation(modelPrice, 'modelprice_err') ?
            true : false : false : false : false : false : false : false : false : false : false);
}

/* Validation for form edit Pricelist */
function editPricelistvali()
{
    var slcttxtGame = document.getElementById("select_game");
    var txtProductNum = document.getElementById("ip_prodnum");
    var ddSelctBrand = document.getElementById("show_other_brand");
    var selctOtherBrand = document.getElementById("other_brnd");
    var selctBrandType = document.getElementById("pricelist_type");
    var selctCarModel = document.getElementById("show_other_model");
    var otherCarOptions = document.getElementById("othercarinput");
    var txtPrice = document.getElementById("carmodel_price");

    return (emptyValidation(slcttxtGame, 'selctdd_err') ?
            emptyValidation(txtProductNum, 'ip_prodnum_err') ?
            alphaNumeric(txtProductNum, 'ip_prodnum_err') ?
            emptyValidation(ddSelctBrand, 'selct_err') ?
            CheckTags(selctOtherBrand, 'other_brnd_err') ?
            emptyValidation(selctBrandType, 'typeip_err') ?
            alphaNumeric(selctBrandType, 'typeip_err') ?
            emptyValidation(selctCarModel, 'otherdd_err') ?
            CheckTags(otherCarOptions, 'othercarinput_err') ?
            emptyValidation(txtPrice, 'carmodel_price_err') ?
            true : false : false : false : false : false : false : false : false : false : false);
}


/* Validation for form Add Inventory */
function addInventoryvali()
{
    var txtinpGame = document.getElementById("select_game");
    var txtinpProduct = document.getElementById("productnum_id");
    var ddinpBrand = document.getElementById("show_other_brand");
    var othrddinpBrand = document.getElementById("oherbrndname_inp");
    var brandinpType = document.getElementById("carstypeinp");
    var otherinpModel = document.getElementById("show_other_model");
    var showotherinpModel = document.getElementById("otheraddedmodel");
    var inpmodelPrice = document.getElementById("inpCost");
    var inpQuantity = document.getElementById("inpquantity");
    var radioA = document.getElementById("result_radio_on");
    var radioC = document.getElementById("result_radio_off");

    return (emptyValidation(txtinpGame, 'gameselct_err') ?
            emptyValidation(txtinpProduct, 'productnum_id_err') ?
            alphaNumeric(txtinpProduct, 'productnum_id_err') ?
            emptyValidation(ddinpBrand, 'brndname_err') ?
            CheckTags(othrddinpBrand, 'oherbrnd_inp_err') ?
            emptyValidation(brandinpType, 'carstypeinp_err') ?
            alphaNumeric(brandinpType, 'carstypeinp_err') ?
            emptyValidation(otherinpModel, 'selctcar_err') ?
            CheckTags(showotherinpModel, 'otheraddedmodel_err') ?
            emptyValidation(inpmodelPrice, 'inpcost_err') ?
            alphaNumeric(inpmodelPrice, 'inpcost_err') ?
            emptyValidation(inpQuantity, 'inpquantity_err') ?
            redioOnOff2(radioA,radioC, 'radio_group_err') ?
            true : false : false : false : false : false : false : false : false : false : false : false : false : false);
}



/* Validation for form Edit Inventory */
function editInventoryvali()
{
    var txteditGame = document.getElementById("select_game");
    var txteditProduct = document.getElementById("input_product");
    var ddeditBrand = document.getElementById("show_other_brand");
    var otherBrand = document.getElementById("other_brand_input");
    var brandeditType = document.getElementById("cr_type");
    var othereditModel = document.getElementById("show_other_model");
    var otherModelShow = document.getElementById("other_model_show");
    var editmodelPrice = document.getElementById("inpcost_edit");
    var editinpQuantity = document.getElementById("edit_inpquantity");

    return (emptyValidation(txteditGame, 'selctedit_err') ?
            emptyValidation(txteditProduct, 'input_product_err') ?
            alphaNumeric(txteditProduct, 'input_product_err') ?
            emptyValidation(ddeditBrand, 'sobinp_err') ?
            CheckTags(otherBrand, 'obinp_err') ?
            emptyValidation(brandeditType, 'cr_type_err') ?
            alphaNumeric(brandeditType, 'cr_type_err') ?
            emptyValidation(othereditModel, 'txtmodel_err') ?
            CheckTags(otherModelShow, 'other_model_err') ?
            emptyValidation(editmodelPrice, 'inpcost_edit_err') ?
            emptyValidation(editinpQuantity, 'edit_inpquantity_err') ?
            alphaNumeric(editinpQuantity, 'edit_inpquantity_err') ?
            true : false : false : false : false : false : false : false : false : false : false : false : false);
}

/* Check Empty text fields. */

function emptyValidation(control, msgBox) {

    var control_len = control.value.length;
    if (control_len === 0) {
        document.getElementById(msgBox).innerHTML = '&nbsp;This is required field';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}

/* Check  radio  text fields. */
function redioOnOff2(a,b, msgBox) {
    if (a.checked === false && b.checked === false) {
        document.getElementById(msgBox).innerHTML = 'Please select Option';
        return false;
    } else {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    }
}

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