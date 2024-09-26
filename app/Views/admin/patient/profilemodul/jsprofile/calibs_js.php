<script type="text/javascript">
  let BASE_URL = "<?php echo base_url(); ?>"


  function getData(response, url, beforesend) {
    $.ajax({
      xhrFields: {
        withCredentials: true
      },
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
        errorSwal(err)
        console.log("Ajax process Failed", err);

      },
    });
  }

  function errGetData(url, successFunction, errorFunction, beforesend) {
    $.ajax({
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
        errorCallbackMethod(err)

        errorSwal(err);
      },
    });
  }

  // beforecreate: function postSyncData(data, url, response, beforesend) {
  function postSyncData(data, url, response, beforesend) {
    $.ajax({
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      xhrFields: {
        withCredentials: true
      },
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
      error: (err) => errorCallbackMethod(err),
    });
  };

  function putData(data, url, response, beforesend) {
    $.ajax({
      xhrFields: {
        withCredentials: true
      },
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
</script>