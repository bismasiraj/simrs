document.addEventListener("DOMContentLoaded", (event) => {
  // Check if the localStorage contains a login event
  if (localStorage.getItem("userLoggedIn") === "true") {
    // Perform actions needed after login
    console.log("User is logged in");
  }

  // Listen for changes to localStorage
  window.addEventListener("storage", (event) => {
    if (event.key === "userLoggedIn" && event.newValue === "true") {
      // Trigger a refresh or update based on the login event
      window.location.reload();
    }
  });
});

function successMsg(msg) {
  $("#successToastBody").html(msg);
  $("#successToastHeader").html("Berhasil");
  $("#successToast").toast("show");
}
function errorMsg(msg) {
  $("#warningToastBody").html(msg);
  $("#warningToastHeader").html("Gagal");
  $("#warningToast").toast("show");
}
function holdModal(modalId) {
  console.log("#" + modalId);
  $("#" + modalId).modal({
    backdrop: "static",
    keyboard: false,
    show: true,
  });
}
function datediff(first, second) {
  return Math.round((second - first) / (1000 * 60 * 60 * 24));
}

function successSwal(msg) {
  swal.fire({
    // title: 'Success',
    text: msg,
    icon: "success",
    timer: 3000,
    showConfirmButton: false,
    showCancelButton: false,
    customClass: {
      container: "custom-success-swal",
    },
  });
}

function errorSwal(msg) {
  Swal.fire({
    icon: "error",
    title: "Gagal",
    text: msg,
    timer: 5000,
    showConfirmButton: false,
  });
}

// template laod 1
function loadingScreen() {
  return (template = `<tr id="loadingRow">
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
                  </tr>`);
}

function tempTablesNull() {
  return (template = `<tr style="height: 200px;">
                      <td colspan="20">
                          <h3>Data Kosong</h3>
                      </td>
                  </tr>`);
}

var BASE_URL = `/`;

function getData(response, url, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      errorSwal(err);
      console.log("Ajax process Failed", err);
    },
  });
}

function errGetData(url, successFunction, errorFunction, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: (res) => {
      successFunction(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: errorFunction,
  });
}

function getDataList(url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    statusCode: errorStatusCode,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (jqXHR) => {
      if (jqXHR.status === 401) {
        loginExpired();
      }
      errorFunction(jqXHR);
    },
  });
}

// beforecreate: function getSyncData(url, response, beforesend) {
function getSyncData(url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log("Ajax process Failed", err);
      if (err.status === 401) {
        loginExpired();
      }
    },
    async: false,
  });
}

// beforecreate: function publicSyncGet(url, response, beforesend) {
function publicSyncGet(url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log(err);
      // if (err.status === 401) {
      //   loginExpired();
      // }
    },
    async: false,
  });
}

function getDataNoAuthSource(url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log("Ajax process Failed", err);
    },
  });
}

const libAsyncAwaitGet = (url) => {
  return $.ajax({
    xhrFields: { withCredentials: true },
    type: "GET",
    contentType: "application/json",
    url: BASE_URL + url,
    error: (err) => {
      console.log("Ajax process Failed", err);
      if (err.status === 401) loginExpired();
    },
  });
};
const libAsyncAwaitPutUrl = (url) => {
  return $.ajax({
    xhrFields: {
      withCredentials: true,
    },
    type: "PUT",
    contentType: "application/json",
    url: BASE_URL + url,
    error: (err) => {
      console.log("Ajax request failed", err);
      if (err.status === 401) {
        loginExpired();
      }
    },
  });
};

function postData(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      errorSwal(err.status);
      // errorCallbackMethod(err);
    },
  });
}
function postDataForm(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: false, // Important for FormData
    processData: false, // Important for FormData
    dataType: "json",
    cache: false,
    url: BASE_URL + url,
    data: data,
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      errorSwal(err.status);
    },
  });
}

// beforecreate: function postSyncData(data, url, response, beforesend) {
function postSyncData(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log("Ajax process Failed", err);
      if (err.status === 401) {
        loginExpired();
      }
    },
    async: false,
  });
}

// beforecreate: function publicPostSyncData(data, url, response, beforesend) {
function publicPostSyncData(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log("Ajax process Failed", err);
    },
    async: false,
  });
}

const libAsyncAwaitPost = (data, url) => {
  return $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    error: (err) => {
      console.log("Ajax process Failed", err);
      if (err.status === 401) loginExpired();
    },
  });
};

function postDataNoAuthSource(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      console.log("Ajax process Failed", err);
    },
  });
}

const newErrorPost = (props) => {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + props.url,
    data: JSON.stringify(props.data),
    beforeSend: (before) => props.beforesend(before),
    success: (result) => {
      props.success(result);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (error) => props.error(error),
  });
};

function errPostData(data, error, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: error,
  });
}

const postDataState = (data, url, response, beforesend, abort) => {
  window.xhrProcess = true;
  window.xhrRequest = $.ajax({
    xhrFields: { withCredentials: true },
    type: "POST",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => errorSwal(err.status),
    // errorCallbackMethod(err),
  });
};

function putData(data, url, response, beforesend) {
  $.ajax({
    xhrFields: { withCredentials: true },
    type: "PUT",
    contentType: "application/json",
    url: BASE_URL + url,
    data: JSON.stringify(data),
    beforeSend: beforesend,
    success: (res) => {
      response(res);

      if ($("#sidebar") && $("#sidebar").length > 0) {
        setContentHeight();
      }
    },
    error: (err) => {
      errorSwal(err);
      console.log("Ajax process Failed", err);
      if (err.status === 401) {
        loginExpired();
      }
    },
  });
}

function putDataUrl(url, response, beforesend) {
  $.ajax({
    xhrFields: {
      withCredentials: true,
    },
    type: "PUT",
    contentType: "application/json",
    url: BASE_URL + url,
    beforeSend: beforesend,
    success: response,
    error: (err) => {
      console.log("Ajax request failed", err);
      if (err.status === 401) {
        loginExpired();
      }
    },
  });
}

const beforesendLoading = (el) => {
  $(`${el}`).html(`
  <div id="beforesend-animations" style="position: relative">
    <div
      class="preload d-flex align-items-center justify-content-center"
      style="position: absolute;
      height: 280px;
      width: 55vw;
      background: transparent;
      z-index: 99;"
    >
      <div>
        <img
          src="<?= base_url('assets/img/loading.gif') ?>"
          style="width: 100px"
          alt="preload"
          class="img-fluid preload-animations"
        />
        <div
          class="d-flex justify-content-center text-primary mt-3"
        >
          loading
        </div>
      </div>
    </div>
  </div>`);
};

const errorFunction = (jqXHR) => {
  $("#beforesend-animations").html(`
  <div
    class="preload d-flex align-items-center justify-content-center"
    style="position: absolute;
    height: 280px;
    width: 55vw;
    background: transparent;
    z-index: 99;"
  >
    <div class="text-center p-5 border">
      <div
        class="text-center text-primary mt-3 px-5"
      >
        <span class="font-weight-bold">
          Oops ! <br />
        </span>
        <h1>Error ${jqXHR.status}</h1>
        ${
          jqXHR.status === 400
            ? "Bad Request"
            : jqXHR.status === 401
            ? "Unauthorized"
            : jqXHR.status === 402
            ? "Payment Required"
            : jqXHR.status === 403
            ? "Forbidden"
            : jqXHR.status === 404
            ? "Not Found"
            : jqXHR.status === 405
            ? "Method Not Allowed"
            : jqXHR.status === 406
            ? "Not Acceptable"
            : jqXHR.status === 407
            ? "Proxy Authentication Required"
            : jqXHR.status === 408
            ? "Request Timeout"
            : jqXHR.status === 409
            ? "Conflict"
            : jqXHR.status === 410
            ? "Gone"
            : jqXHR.status === 411
            ? "Length Required"
            : jqXHR.status === 412
            ? "Precondition Failed"
            : jqXHR.status === 413
            ? "Payload Too Large"
            : jqXHR.status === 414
            ? "URI Too Long"
            : jqXHR.status === 415
            ? "Unsupported Media Type"
            : jqXHR.status === 416
            ? "Requested Range Not Satisfiable"
            : jqXHR.status === 417
            ? "Expectation Failed"
            : jqXHR.status === 418
            ? "I'm a teapot"
            : jqXHR.status === 421
            ? "Misdirected Request"
            : jqXHR.status === 422
            ? "Unprocessable Entity"
            : jqXHR.status === 423
            ? "Locked"
            : jqXHR.status === 424
            ? "Failed Dependency"
            : jqXHR.status === 425
            ? "Too Early"
            : jqXHR.status === 426
            ? "Upgrade Required"
            : jqXHR.status === 428
            ? "Precondition Required"
            : jqXHR.status === 429
            ? "Too Many Requests"
            : jqXHR.status === 431
            ? "Request Header Fields Too Large"
            : jqXHR.status === 451
            ? "Unavailable For Legal Reasons"
            : jqXHR.status === 500
            ? "Internal Server Error"
            : jqXHR.status === 501
            ? "Not Implemented"
            : jqXHR.status === 502
            ? "Bad Gateway"
            : jqXHR.status === 503
            ? "Service Unavailable"
            : jqXHR.status === 504
            ? "Gateway Time-Out"
            : jqXHR.status === 505
            ? "HTTP Version Not Supported"
            : jqXHR.status === 506
            ? "Variant Also Negotiates"
            : jqXHR.status === 507
            ? "Insufficient Storage"
            : jqXHR.status === 508
            ? "Loop Detected"
            : jqXHR.status === 510
            ? "Not Extended"
            : jqXHR.status === 511
            ? "Network Authentication Required"
            : "Something Wrong"
        }
                            <br />
        <a href="#" class="text-primary" onclick="window.location.reload()">refresh page</a>
      </div>
    </div>
  </div>`);
};

const loadingDialogClose = () => {
  setTimeout((e) => {
    $(
      $("#loading-modal").length > 0 ? "#loading-modal" : ".modal.fade.show"
    ).modal("hide");
  }, 500);
};

const errorCallbackMethod = (err) => {
  if (err.status === 500 || err.code === 500) {
    console.log("Internal server error", err);
    setTimeout(() => {
      loadingDialogClose();
      errorSwal(`Internal server error \nStatus: ${err.status}`);
      alert(`Internal server error \nStatus: ${err.status}`);
    }, 2010);
  } else if (err.status === 401) {
    loginExpired();
  } else if ([501, 503].indexOf(err.status) !== -1) {
    console.log("Internal server error", err);
    setTimeout(() => {
      loadingDialogClose();

      alert(`Internal server error \nStatus: ${err.status}`);
    }, 2010);
  } else if (err.status === 502) {
    if (err.responseJSON) {
      console.log(err.responseJSON.error.code, err.responseJSON.error.message);

      setTimeout(() => {
        loadingDialogClose();
        alert(
          err.responseJSON.error.code +
            " - " +
            err.responseJSON.error.message +
            "\nStatus: " +
            err.status
        );
      }, 2010);
    } else {
      console.log("Internal server error", err);
      setTimeout(() => {
        loadingDialogClose();
        alert(`Internal server error \nStatus: ${err.status}`);
      }, 2010);
    }
  } else if (err.status === 504) {
    console.log("Geteway Timeout", err);
    setTimeout(() => {
      loadingDialogClose();
      alert(`Internal server error\nStatus: ${err.status}`);
    }, 2010);
  } else if (err.status === 0) {
    console.log("Tidak dapat terhubung ke server", err);
    setTimeout(() => {
      loadingDialogClose();
      alert(`Tidak dapat terhubung ke server \nStatus: ${err.status}`);
    }, 2010);
  } else if (err.status === 429) {
    setTimeout(() => {
      loadingDialogClose();
      alert(
        `Terlalu banyak permintaan, silahkan coba kembali beberapa saat lagi. \nStatus: ${err.status}`
      );
    }, 2010);
  } else {
    console.log("Unknown Error", err);
    setTimeout(() => {
      loadingDialogClose();
      alert(`Unknown Error \nStatus: ${err.status}`);
    }, 2010);
  }
};

// ?-------------------
// template laod 2
function loadingScreenRound() {
  return `<tr id="loadingRow">
                      <td colspan="10">
                          <div class="preload d-flex align-items-center justify-content-center">
                             <div class="arc"></div>
                          </div>
                      </td>
                  </tr>`;
}

// loading screan
function getLoadingscreen(val, load) {
  $(`#${val}`).hide();
  $(`#${load}`).show();
  // $(`#${load}`).html(loadingScreenRound());
  $(`#${load}`).html(loadingScreen());

  setTimeout(function () {
    $(`#${load}`).hide();
    $(`#${val}`).show();
  }, 3000);
}

function getLoadingGlobalServices(val) {
  $(`#${val}`).html(loadingScreen());
}

// ?-------------------

function evaluateScore(inputValue, type, value) {
  if (inputValue === 1) {
    // Use getNeonatalScore
    return getAdultScore(type, value);
  } else if (inputValue === 4) {
    // Use getAdultScore
    return getNeonatalScore(type, value);
  } else if (inputValue === 10) {
    // Use getAdultScore
    return getObsetricScore(type, value);
  } else {
    // Handle invalid or other cases if needed
    return getAdultScore(type, value);
  }
} //new 30/07

function getObsetricScore(type, value) {
  switch (type) {
    // === SPO2 === //
    case "saturasi":
      if (value <= 91) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 92 && value <= 95) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 96) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;
    // === SATURASI 2=== //
    case "saturasi2":
      if (value <= 83) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 84 && value <= 85) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 86 && value <= 87) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 88 && value <= 92) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 93 && value <= 94) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 95 && value <= 96) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 97) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }

      break;

    // === PERNAPASAN === //
    case "pernapasan":
      if (value < 12) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 12 && value <= 20) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 21 && value <= 25) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value > 25) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;
    // === TEKANAN DARAH === //
    case "darah":
      if (value < 90) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 90 && value <= 140) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 141 && value <= 150) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 151 && value <= 160) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value > 160) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === NADI === //
    case "nadi":
      if (value < 50) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 50 && value <= 60) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 61 && value <= 100) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 101 && value <= 110) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 180) {
      } else if (value >= 111 && value <= 120) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 120) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === SUHU / TEMPERATUR === //
    case "suhu":
      if (value <= 35) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 37.3 && value <= 37.7) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 36.1 && value <= 37.2) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 37.6) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === TINGKAT KESADARAN === //
    case "kesadaran":
      if (value === "Sadar") {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (
        value === "Nyeri" ||
        value === "Verbal" ||
        value === "Unrespon"
      ) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === OKSIGEN === //
    case "oksigen":
      if (value) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;
    case "awareness":
      if (value == 10) {
        return {
          score: 10,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value == 3) {
        return {
          score: 3,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value == 0) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }
    case "pain":
      if (value == 3) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#ffc107",
        };
      } else if (value == 0) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }
    case "lochia":
      if (value == 3) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#ffc107",
        };
      } else if (value == 0) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }

    case "proteinuria":
      if (value == 3) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#ffc107",
        };
      } else if (value == 2) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }
  }
} //new 30/07
function getAdultScore(type, value) {
  switch (type) {
    // === PERNAPASAN === //
    case "pernapasan":
      if (value <= 8) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 9 && value <= 11) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 12 && value <= 20) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 21 && value <= 24) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 25) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === SATURASI === //
    case "saturasi":
      if (value <= 91) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 92 && value <= 93) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 94 && value <= 95) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 96) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }

      break;

    // === SATURASI 2=== //
    case "saturasi2":
      if (value <= 83) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 84 && value <= 85) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 86 && value <= 87) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 88 && value <= 92) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 93 && value <= 94) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 95 && value <= 96) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 97) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }

      break;

    // === OKSIGEN === //
    case "oksigen":
      if (value) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === TEKANAN DARAH === //
    case "darah":
      if (value <= 70) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 71 && value <= 80) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 81 && value <= 100) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 101 && value <= 160) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 161 && value <= 200) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 201 && value <= 219) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 220) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === NADI === //
    case "nadi":
      if (value <= 40) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 41 && value <= 50) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 51 && value <= 90) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 91 && value <= 110) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 111 && value <= 130) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 131) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }

      break;

    // === TINGKAT KESADARAN === //
    case "kesadaran":
      if (value === "Compos Mentis") {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (
        value === "Apatis" ||
        value === "Samnolen" ||
        value === "Delirium" ||
        value === "Sopor" ||
        value === "Comma"
      ) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === SUHU / TEMPERATUR === //
    case "suhu":
      if (value <= 35.0) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 35.1 && value <= 36.0) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 36.1 && value <= 38.0) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 38.1 && value <= 39.0) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 39.1) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      }
      break;
    case "awareness":
      if (value == 10) {
        return {
          score: 10,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value == 3) {
        return {
          score: 3,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value == 0) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }
  }
}

function getNeonatalScore(type, value) {
  switch (type) {
    // === SPO2 === //
    case "saturasi":
      if (value <= 85) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === SATURASI 2=== //
    case "saturasi2":
      if (value <= 83) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 84 && value <= 85) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 86 && value <= 87) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 88 && value <= 92) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 93 && value <= 94) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 95 && value <= 96) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 97) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }

      break;

    // === PERNAPASAN === //
    case "pernapasan":
      if (value < 30) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 30 && value <= 60) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 61 && value <= 80) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value > 80) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;
    // === TEKANAN DARAH === //
    case "darah":
      if (value <= 70) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 71 && value <= 80) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 81 && value <= 100) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 101 && value <= 160) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 161 && value <= 200) {
        return {
          score: 1,
          color: "success",
          colorPicker: "#198754",
        };
      } else if (value >= 201 && value <= 219) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 220) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === NADI === //
    case "nadi":
      if (value < 100) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 100 && value <= 119) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 120 && value <= 160) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 161 && value <= 180) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 180) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === SUHU / TEMPERATUR === //
    case "suhu":
      if (value <= 35.5) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value >= 35.6 && value <= 37.5) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value >= 37.6 && value <= 37.9) {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value >= 38.0) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === OKSIGEN === //
    case "oksigen":
      if (value) {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === TINGKAT KESADARAN === //
    case "kesadaran":
      if (value === "Compos Mentis") {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (
        value === "Apatis" ||
        value === "Samnolen" ||
        value === "Delirium" ||
        value === "Sopor" ||
        value === "Comma"
      ) {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      }
      break;

    // === NEURO === //
    case "neuro":
      if (value === "Aktf") {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value === "Tidak Aktf") {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value === "Letargi") {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value === "Kejang") {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;

    // === WARNA KULIT === //
    case "kulit":
      if (value === "Pink") {
        return {
          score: 0,
          color: "light",
          colorPicker: "#f8f9fa",
        };
      } else if (value === "Pucat") {
        return {
          score: 2,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value === "Slanosis") {
        return {
          score: 3,
          color: "danger",
          colorPicker: "#dc3545",
        };
      }
      break;
    case "awareness":
      if (value == 10) {
        return {
          score: 10,
          color: "danger",
          colorPicker: "#dc3545",
        };
      } else if (value == 3) {
        return {
          score: 3,
          color: "warning",
          colorPicker: "#ffc107",
        };
      } else if (value == 0) {
        return {
          score: 0,
          color: "success",
          colorPicker: "#198754",
        };
      }
  }
}
const errorStatusCode = {
  504: (response, textStatus, thrown) => {
    $("#beforesend-animations").html(`
      <div
        class="preload d-flex align-items-center justify-content-center"
        style="position: absolute;
        height: 280px;
        width: 55vw;
        background: transparent;
        z-index: 99;"
      >
        <div class="text-center p-5 border">
          <div class="text-center text-primary mt-3 px-5">
            <span class="font-weight-bold">
              Oops ! <br />
            </span>
            <h1>Error ${thrown.status}</h1>
            Gateway Time-Out <br />
            <a href="#" class="text-primary" onclick="window.location.reload()">
              refresh page
            </a>
          </div>
        </div>
      </div>`);
  },
};

function get_bodyid() {
  const date = new Date();
  let bodyId = date.toISOString().substring(0, 23);
  bodyId = bodyId.replace(/[-:.T]/g, "") + makeid(3);
  return bodyId;
}

function makeid(length) {
  let result = "";
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}

function setBadge(propId, badgeId, className, textContent) {
  var badge = document.getElementById(badgeId);
  if (badge) {
    if (className == "bg-light") {
      badge.className =
        "badge-score h6 badge position-absolute top-50 start-100 translate-middle text-dark border border-1 border-dark " +
        className;
      badge.textContent = textContent;
    } else {
      badge.className =
        "badge-score h6 badge position-absolute top-50 start-100 translate-middle " +
        className;
      badge.textContent = textContent;
    }
  }
}

function sumTextContentFromClass(className) {
  var elements = document.getElementsByClassName(className);
  var totalSum = 0;

  for (var i = 0; i < elements.length; i++) {
    var text = elements[i].textContent.trim();
    var value = parseFloat(text);

    if (!isNaN(value)) {
      totalSum += value;
    }
  }

  return totalSum;
}

function vitalsignInput(prop) {
  var value = prop.value.trim();
  var id = prop.id;
  var name = prop.name; //+ (prop.uniq_name ? prop.uniq_name : ""); //=new
  var identifier = id.replace(name, "");
  var data;
  var totalScore = [];

  if (isNaN(value) || value === "") {
    value = 0;
  } else {
    value = parseFloat(value);
  }
  let ewsId = $("#" + id)
    .closest("form")
    .find('input[name="vs_status_id"]');

  let scoreFunction;
  if (ewsId.val() == 1) {
    scoreFunction = getAdultScore;
  } else if (ewsId.val() == 5) {
    scoreFunction = getNeonatalScore;
  } else if (ewsId.val() == 10) {
    scoreFunction = getObsetricScore;
  } else {
    scoreFunction = getAdultScore;
  }

  switch (true) {
    case name.startsWith("nadi"):
      data = scoreFunction("nadi", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("temperature"):
      data = scoreFunction("suhu", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("saturasi"):
      data = scoreFunction("saturasi", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("nafas"):
      data = scoreFunction("pernapasan", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("oxygen_usage"):
      data = scoreFunction("oksigen", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("awareness"):
      data = scoreFunction("awareness", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("pain"):
      data = scoreFunction("pain", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("lochia"):
      data = scoreFunction("lochia", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("proteinuria"):
      data = scoreFunction("proteinuria", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("weight"):
      if (value < 0) {
        value = 0.0;
      } else if (value > 300) {
        value = 300.0;
      } else {
        value = value.toFixed(2);
      }
      break;
    case name.startsWith("tension_upper"):
      if (value < 50) {
        value = 50.0;
      } else if (value > 250) {
        value = 250.0;
      }
      data = scoreFunction("darah", value);
      setBadge(id, "badge-" + id, "bg-" + data?.color, data?.score);
      break;
    case name.startsWith("tension_below"):
      if (value < 0) {
        value = 0.0;
      } else if (value > 300) {
        value = 300.0;
      }
      break;
    case name.includes("height"):
      if (value > 250) {
        value = 250;
      }
      // Additional processing if required for height-related cases
      break;
    default:
      // Optionally handle unknown cases or log an error
      console.warn("Unhandled case:", name);
      break;
  }

  prop.value = value;
  data1 = scoreFunction("nadi", $("#" + identifier + "nadi").val());
  data2 = scoreFunction("suhu", $("#" + identifier + "temperature").val());
  data3 = scoreFunction("saturasi", $("#" + identifier + "saturasi").val());
  data4 = scoreFunction("pernapasan", $("#" + identifier + "nafas").val());
  data5 = scoreFunction("oksigen", $("#" + identifier + "oxygen_usage").val());
  data6 = scoreFunction("darah", $("#" + identifier + "tension_upper").val());
  data7 = scoreFunction("awareness", $("#" + identifier + "awareness").val());

  let totalSkor =
    data1?.score +
    data2?.score +
    data3?.score +
    data4?.score +
    data5?.score +
    data6?.score +
    data7?.score;
  $("#" + identifier + "total_score").html("Total Skor: " + totalSkor);

  // document.getElementById('total_score').textContent = 'Total Skor: ' + sumTextContentFromClass('badge-score');
}

function changeEwsParam(className) {
  var optionSelected = $("option:selected", this);
  $(".className").each((index, each) => {
    $(each).change((element) => {
      vitalsignInput({
        value: $(each).val(),
        name: $(each).attr("name"),
        id: $(each).attr("id"),
        type: optionSelected.val(),
      });
    });
    vitalsignInput({
      value: $(each).val(),
      name: $(each).attr("name"),
      id: $(each).attr("id"),
      type: optionSelected.val(),
    });
  });
}

function datetimepickerbyid(flatid) {
  flatpickr("#" + flatid, {
    enableTime: true,
    dateFormat: "d/m/Y H:i", // Display format
    time_24hr: true, // 24-hour time format
    minuteIncrement: 1,
  });
  $("#" + flatid).prop("readonly", false);
  $("#" + flatid).on("change", function () {
    let theid = flatid.replace("flat", "");
    let thevalue = $(this).val();
    let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format(
      "YYYY-MM-DD HH:mm"
    );
    $("#" + theid)
      .val(formattedDate)
      .trigger("change");
  });
  $("#" + flatid)
    .val(moment().format("DD/MM/YYYY HH:mm"))
    .trigger("change");
}
let flatpickrInstances = {}; // Object to hold instances
function datetimepickerbyidinitial(
  flatid,
  initial = moment().format("DD/MM/YYYY HH:mm")
) {
  flatpickrInstances[flatid] = flatpickr("#" + flatid, {
    enableTime: true,
    dateFormat: "d/m/Y H:i", // Display format
    time_24hr: true, // 24-hour time format
    defaultDate: initial,
    minuteIncrement: 1,
  });
  $("#" + flatid).prop("readonly", false);
  $("#" + flatid).on("change", function () {
    let theid = flatid.replace("flat", "");
    let thevalue = $(this).val();
    let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format(
      "YYYY-MM-DD HH:mm"
    );
    $("#" + theid)
      .val(formattedDate)
      .trigger("change");
  });
  // $("#" + flatid)
  //   .val(moment().format("DD/MM/YYYY HH:mm"))
  //   .trigger("change");
}
function datepickerbyidinitial(
  flatid,
  initial = moment().format("DD/MM/YYYY HH:mm")
) {
  flatpickrInstances[flatid] = flatpickr("#" + flatid, {
    enableTime: true,
    dateFormat: "d/m/Y H:i", // Display format
    time_24hr: true, // 24-hour time format
    defaultDate: initial,
    minuteIncrement: 1,
  });
  $("#" + flatid).prop("readonly", false);
  $("#" + flatid).on("change", function () {
    let theid = flatid.replace("flat", "");
    let thevalue = $(this).val();
    let formattedDate = moment(thevalue, "DD/MM/YYYY HH:mm").format(
      "YYYY-MM-DD HH:mm"
    );
    $("#" + theid)
      .val(formattedDate)
      .trigger("change");
  });
  // $("#" + flatid)
  //   .val(moment().format("DD/MM/YYYY HH:mm"))
  //   .trigger("change");
}
function formatedDatetimeFlat(thedatetime) {
  let formatedDate = moment(thedatetime).format("DD/MM/YYYY HH:mm");
  return formatedDate;
}
function formatedDateFlat(thedatetime) {
  let formatedDate = moment(thedatetime).format("DD/MM/YYYY");
  return formatedDate;
}
function originalFormatedDatetimeFlat(thedatetime) {
  let formatedDate = moment(thedatetime, "DD/MM/YYYY HH:mm").format(
    "YYYY-MM-DD HH:mm"
  );
  return formatedDate;
}

const nowtime = moment().format("DD/MM/YYYY HH:mm");
const nowdate = moment().format("DD/MM/YYYY");

function removeById(id) {
  $("#" + id).remove();
}
function removeByClass(className) {
  $("." + className).remove();
}

function triggerRefresh() {
  localStorage.setItem("refresh", new Date().toISOString());
}

function initializeQuillEditors() {
  let quillInstances;
  document.querySelectorAll(".quill-editor").forEach((editor) => {
    if (!quillInstances[editor.id]) {
      const quill = new Quill(editor, {
        theme: "snow",
      });

      quillInstances[editor.id] = quill;

      const inputField = document.querySelector(
        `input[name="${editor.getAttribute("name")}"]`
      );
      if (inputField) {
        const initialContent = inputField.value || "";
        quill.root.innerHTML = initialContent;

        quill.on("text-change", () => {
          const quillContent = quill.root.innerHTML.trim();
          inputField.value = quillContent === "<p><br></p>" ? "" : quillContent;
        });
      }
    }
  });
}
function initializeQuillEditorsById(idname, initialvalue = "") {
  // Initialize Quill editor
  const quill = new Quill("#" + idname, {
    theme: "snow",
  });

  // Get the associated input field
  const inputField = document.querySelector(
    `input[name="${document.querySelector("#" + idname).getAttribute("name")}"]`
  );

  if (inputField) {
    // Set initial content
    const initialContent = inputField.value || "";
    quill.root.innerHTML = initialContent;

    // Listen for changes and update input field
    quill.on("text-change", () => {
      const quillContent = quill.root.innerHTML.trim();
      inputField.value = quillContent === "<p><br></p>" ? "" : quillContent;
    });
  }
}
function formBtnChangePassword() {}

function togglePasswordVisibility(inputId, button) {
  var input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
    button.classList.add("btn-outline-primary");
  } else {
    input.type = "password";
    button.classList.remove("btn-outline-primary");
  }
}
function openPopUpTab(url) {
  const screenWidth = window.innerWidth;
  const screenHeight = window.innerHeight;

  // Set desired width and height as a percentage of the screen size
  const width = Math.floor(screenWidth * 0.6); // 80% of the screen width
  const height = Math.floor(screenHeight * 0.9); // 80% of the screen height
  window.open(
    url,
    "_blank",
    `toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=${width},height=${height}`
  );
}
$(document).ready(function () {
  $(".modal-change-password")
    .off()
    .on("click", function (e) {
      $("#changePasswordModal").modal("show");
    });
  $("#changePasswordForm").on("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);
    let jsonObj = {};

    formData.forEach((value, key) => {
      jsonObj[key] = value;
    });

    postData(jsonObj, "Home/changePassword", (res) => {
      if (res.success) {
        successSwal("Password successfully updated!");
        $("#changePasswordModal").modal("hide");
        $("#changePasswordForm")[0].reset();
      } else {
        errorSwal(res.message);
      }
    });
  });
});
