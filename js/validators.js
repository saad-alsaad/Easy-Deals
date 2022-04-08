/**
 * Created by saad on 4/25/2017.

function check(){

}
 */
function password_validator(password_id,effect_On_id) {
    if(check_password($(password_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
        }
}

function address_validator(address_id,effect_On_id){
    if(check_address($(address_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function confirmation_validator(password_id,password_confirm_id,effect_On_id) {
    if(check_password_match($(password_id).val(),$(password_confirm_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function email_validator(email_id,effect_On_id) {
    if(check_email($(email_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function name_validator(name_id,effect_On_id){
    if(check_name($(name_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function username_validator(username_id,effect_On_id) {
    if(check_username($(username_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function phone_validator(phone_id,effect_On_id){
    if(check_phone($(phone_id).val()))
        $(effect_On_id).css({'background-color': '#DDFFDD'});
    else{
        $(effect_On_id).css({'background-color': '#ffb7b2'});
    }
}

function check_password(password) {
    var regex1 = /^(?=.*[0-9])(?=.*[!@#$%^&*()_=+|])[a-zA-Z0-9!@#$%^&()_=+|*]{6,20}$/;
    var regex2 = /^(?=.*[0-9])(?=.*[!@#$%^&()_=+|*])[أ-ي0-9!@#$%^&()_=+|*]{6,16}$/;
    return (regex1.test(password) || regex2.test(password));
}

function check_password_match(password,password_confirm){
    return (password == password_confirm);
}

function check_phone(phone){
    return /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/.test(phone);
}

function check_email(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( email );
}

function check_name(name){
    var regex = /^[أ-ي]{3,20}$/;
    var regex2 = /^[A-Za-z]{3,20}$/;
  return (regex.test(name) || regex2.test(name));

}

function check_username(username) {
    return /^[0-9A-Zأ-يa-z]{3,20}$/.test(username);
}

function check_address(address){
    var spaces = 0;

    for(var i=0;i<address.length;i++){
        if(spaces == 12)
            return false;
        if(address[i] == ' ')
            spaces += 1;
    }

    if(address[address.length-1] == ' ')
        return false;

    if(spaces == 0)
        return false;

    var regex = /^[-0-9أ-ي ]{13,60}$/;
    var regex2 = /^[ A-Za-z0-9-]{13,60}$/;
    return (regex.test(address) || regex2.test(address));
}

