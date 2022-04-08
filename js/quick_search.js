/**
 * Created by saad on 5/12/2017.
 */
function state(value,target) {
    $.post(target,{q:value},function (data) {
        $("#live_search").html(data);
    });
}

function add_word(value) {
    $("#word").val(value);
    //alert(value);
}
