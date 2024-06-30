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
function datediff(first, second) {        
    return Math.round((second - first) / (1000 * 60 * 60 * 24));
}

 function successSwal(msg) {
    swal.fire({
        // title: 'Success',
        text: msg,
        icon: 'success',
        timer: 3000, 
        showConfirmButton: false, 
        showCancelButton: false 
    });
}

function errorSwal(msg) {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: msg,
        timer: 5000, 
        showConfirmButton: false 
    });
}

function loadingScreen() {
    return  template = `<tr id="loadingRow">
                        <td colspan="10">
                            <div class="preload d-flex align-items-center justify-content-center">
                                <div class="spinner">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                            </div>
                        </td>
                    </tr>`;
   
}


function tempTablesNull(){
    return template =`<tr style="height: 200px;">
                        <td colspan="4">
                            <h3>Data Kosong</h3>
                        </td>
                    </tr>`
}


