
$("#datepicker").datepicker(), $("#datepicker").on("changeDate", function () {
    $("#myHiddenInput").val($("#datepicker").datepicker("getFormattedDate"))
}), $("#datepicker-two").datepicker(), $("#datepicker-two").on("changeDate", function () {
    $("#myHiddenInput").val($("#datepicker").datepicker("getFormattedDate"))
}), $("#datepicker-tree").datepicker(), $("#datepicker-tree").on("changeDate", function () {
    $("#myHiddenInput").val($("#datepicker").datepicker("getFormattedDate"))
}), $(".option").click(function () {
    $(".theme-select").val($(this).text())
}), $(".theme-select-holder").click(function () {
    "none" == $(".option-holder").css("display") ? $(".option-holder").slideDown(300) : $(".option-holder").slideUp(300)
});
$('[data-toggle="popover"]').popover();
$('[data-toggle="tooltip"]').tooltip();
$('#example').DataTable({
    "oLanguage": {
        "oPaginate": {
            "sPrevious": "<",
            "sNext": ">"
        }
    }
});
$(".avatar").click(function () {
    if ($(".profile-menu").css("display") == "none") {
        $(".profile-menu").slideDown(200);
    } else {
        $(".profile-menu").slideUp(200);
    }
});

$("[name='my-checkbox']").bootstrapSwitch();