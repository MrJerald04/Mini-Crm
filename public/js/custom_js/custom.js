$(document).ready(function() {
    $("#date_input").hide();
    $("#customRadio1").click(function() {
        $("#date_input").hide();
    });
    $("#customRadio2").click(function() {
        $("#date_input").show();
    });
    //Initialize Select2 Elements
    $(".select2").select2();
});
$(".form_datetime").datetimepicker({
    //language:  'fr',
    useCurrent: true,
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    showMeridian: 1
});
//show selected image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#logo-img-tag").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#logo-img").change(function() {
    readURL(this);
});
// /end show
