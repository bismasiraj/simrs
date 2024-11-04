$(document).ready(async function () {
  await getLocalIP((ip) => {
    window.ipMe = ip;
    localStorage.setItem("localIP", ip);
  });

  await getIp();
  getDataOne();
  checkVoiceAvailability();

  // getLocalIPAddress()
  //    .then((ip) => console.log("Local IP Address:", ip))
  //    .catch((error) => console.error(error));
});

let voices = [];
let videoFiles = [];
let currentVideoIndex = 0;
let announcedNumbers = new Set();

const populateVoices = () => {
  voices = speechSynthesis.getVoices();
};

window.speechSynthesis.onvoiceschanged = populateVoices;

const getLocalIP = (callback) => {
  const RTCPeerConnection =
    window.RTCPeerConnection ||
    window.mozRTCPeerConnection ||
    window.webkitRTCPeerConnection;
  const pc = new RTCPeerConnection({ iceServers: [] });
  pc.createDataChannel("");
  pc.createOffer().then((offer) => pc.setLocalDescription(offer));

  pc.onicecandidate = (event) => {
    if (!event || !event.candidate) return;
    const ip = /([0-9]{1,3}[.]){3}[0-9]{1,3}/.exec(
      event.candidate.candidate
    )[0];
    callback(ip);
    pc.onicecandidate = null;
  };
};

const getIp = () => {
  return new Promise((resolve) => {
    getDataList("antrian/ip", (res) => {
      // window.ipMe = res.value.ip;
      let ipMe = window.ipMe;
      let results = res.value.data;
      let result = results.filter((item) => item?.display_ip === ipMe);
      videoFiles = res.value.vidio;
      window.vidio = res.value.vidio;
      window.resultData = result.length > 0 ? result[0] : [];

      if (videoFiles.length > 0) {
        initializeVideoPlayer();
      } else {
        console.warn("Tidak ada video yang ditemukan.");
      }

      resolve();
    });
  });
};

async function getLocalIPAddress() {
  return new Promise((resolve, reject) => {
    const peerConnection = new RTCPeerConnection({
      iceServers: [{ urls: "stun:stun.l.google.com:19302" }],
    });

    peerConnection.onicecandidate = (event) => {
      if (event.candidate) {
        const candidate = event.candidate.candidate;
        const ipMatch = candidate.match(
          /(\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b)/
        );
        if (ipMatch) {
          resolve(ipMatch[1]);
          peerConnection.close();
        }
      } else {
        reject("Tidak dapat menemukan alamat IP lokal.");
      }
    };

    peerConnection.createDataChannel("");
    peerConnection
      .createOffer()
      .then((offer) => peerConnection.setLocalDescription(offer))
      .catch(reject);
  });
}

const initializeVideoPlayer = () => {
  const videoPlayer = document.getElementById("videoPlayer");
  videoPlayer.src = `assets/vidio/${videoFiles[currentVideoIndex]}`;
  videoPlayer.volume = 0.1;
  videoPlayer.addEventListener("ended", playNextVideo);
};

const playNextVideo = () => {
  currentVideoIndex = (currentVideoIndex + 1) % videoFiles.length;
  const videoPlayer = document.getElementById("videoPlayer");
  videoPlayer.src = `assets/vidio/${videoFiles[currentVideoIndex]}`;
  videoPlayer.volume = 0.1;
};

const getDataOne = () => {
  if (!window.resultData || window.resultData.length === 0) {
    $("#ip-content").show();
    $("#ip-content").html(`<h1>${window.ipMe}</h1>`);
    console.warn("No result data available");
    return;
  }
  $("#ip-content").hide();
  getDatapolis();
  pemanggilan_antrian();

  $("#poli-content").html(
    `<h1 class="fw-bold">${window.resultData?.name_of_clinic.toUpperCase()}</h1>
       <h3 class="fw-bold">${window.resultData?.fullname}</h3>`
  );

  $("#queueDisplay").show();
  $("#trx-content").show();
  $("#poli-content").show();
  $("#poliSelect").parent().hide();
  $("#employeeSelect").parent().hide();
  $("#startButton").hide();
  $("#stopButton").show();
};

let queueData = [];
let queueInterval;

const updateQueue = (newData) => {
  if (newData.length > 0) {
    const now = new Date();
    const tenSecondsAgo = new Date(now.getTime() - 10 * 1000);

    newData.forEach((data) => {
      const callTime = new Date(data?.tanggal_panggil);

      if (!isNaN(callTime.getTime())) {
        if (callTime > tenSecondsAgo) {
          queueData.push(data);
          displayQueue();
          announceQueue(data);
          announcedNumbers.add(data.no_tiket);
          // $("#poli-content").data("queueData", data).trigger("click");
        }
      } else {
        console.warn(`No valid call time for data: ${JSON.stringify(data)}`);
      }
    });
  }
};

const displayQueue = () => {
  if (queueData.length > 0) {
    const latestData = queueData[queueData.length - 1];
    $("#queueDisplay").html(`
           <h3 class="fw-bold"><u>NO ANTRIAN</u></h3>
           <h1 class="fw-bold">${latestData.no_tiket}</h1>
           <h2 class="fw-bold">${latestData.display_room}</h2>
       `);
  } else {
    $("#queueDisplay").text("Menunggu antrian...");
  }
};

const announceQueue = async (data) => {
  speechSynthesis.cancel();

  if (voices.length === 0) {
    console.warn("Voices belum tersedia. Menunggu beberapa detik...");
    setTimeout(() => announceQueue(data), 1000); // Retry jika suara belum ada
    return;
  }

  const indonesianVoice = voices.find((voice) => voice.lang === "id-ID");

  if (!indonesianVoice) {
    console.error("No voice available.");
    return;
  }

  const text = `Nomor Antrian, ${data.no_tiket.replace(
    /([A-Z])(?=[A-Z])/g,
    "$1,"
  )}, Menuju ${data.name_of_clinic}, ${data.display_room}`;
  const msg = new SpeechSynthesisUtterance(text);
  msg.voice = indonesianVoice;
  msg.rate = 0.9;
  msg.volume = 1;

  let speechExecuted = false;

  msg.onstart = () => {
    speechExecuted = true;
    const videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.pause();
  };

  msg.onend = () => {
    const videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.play();
  };

  msg.onerror = (event) => {
    event;
    // console.error("Error saat memutar suara:", event);
    // setTimeout(() => announceQueue(data), 1000);
  };

  setTimeout(() => {
    if (!speechExecuted) {
      console.warn("Reload");
      announceQueue(data);
    }
  }, 1000);

  speechSynthesis.speak(msg); // Mulai ucapan
  postData(
    {
      visit_id: data.visit_id,
      id: data.id,
    },
    "antrian/updateStatus",
    (res) => {
      console.log(res);
    }
  );
};

const getDatapolis = () => {
  let selectedPoliId = window.resultData.clinic_id;
  let selectedEmployeeId = window.resultData.employee_id;
  postData(
    {
      poli: selectedPoliId,
      employee: selectedEmployeeId,
    },
    "antrian/getData",
    (res) => {
      $("#trx-content").html(`
               <h3 class="fw-bold">JUMLAH PASIEN ${res.value.terlayani.jml_pasien}</h3>
               <h3 class="fw-bold">TERLAYANI ${res.value.terlayani.jml_terlayani}</h3>
           `);
      if (res.respon === true && res.value.data.length > 0) {
        updateQueue(res.value.data);
      }
    }
  );
};

const pemanggilan_antrian = () => {
  queueInterval = setInterval(() => {
    getDatapolis();
  }, 10000);
};

const checkVoiceAvailability = () => {
  setInterval(() => {
    if (voices.length === 0) {
      populateVoices();
    }
  }, 3000); // Cek setiap 5 detik
};

$("#queueDisplay").on("click", function () {
  const customText = "Mulai";
  readCustomText(customText);
});

$("#poli-content").on("click", function () {
  const queueData = $(this).data("queueData");
  if (queueData) {
    announceQueue(queueData);
  }
});

const readCustomText = async (text) => {
  speechSynthesis.cancel();

  if (voices.length === 0) {
    console.warn("Voices belum tersedia. Menunggu beberapa detik...");
    setTimeout(() => readCustomText(text), 1000);
    return;
  }

  const indonesianVoice = voices.find((voice) => voice.lang === "id-ID");

  if (!indonesianVoice) {
    console.error("No voice available.");
    return;
  }

  const msg = new SpeechSynthesisUtterance(text);
  msg.voice = indonesianVoice;
  msg.rate = 1;
  msg.volume = 1;

  msg.onstart = () => {
    const videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.pause();
  };

  msg.onend = () => {
    const videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.play();
  };
  msg.onerror = () => {
    console.error("Error saat memutar suara.");
  };
  speechSynthesis.speak(msg);
};
