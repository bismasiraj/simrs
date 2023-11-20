function successMsg(msg){
    $("#successToastBody").html(msg)
    $("#successToastHeader").html("Berhasil")
    $("#successToast").toast("show")
}
function errorMsg(msg){
    $("#warningToastBody").html(msg)
    $("#warningToastHeader").html("Gagal")
    $("#warningToast").toast("show")
}
function holdModal(modalId) {
    console.log("#"+modalId)
    $('#' + modalId).modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}