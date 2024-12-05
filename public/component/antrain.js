$(document).ready(async function () {
   libModal();
   await getIp();
   getDataOne();
   checkVoiceAvailability();
   updateClock();
   getIPAddress().then((ip) => {
      if (ip) {
         console.log("IP Anda:", ip);
      }
   });
});

const updateClock = () => {
   const timeString = moment(new Date()).format("DD MMM YYYY HH:mm:ss");
   $("#clock").html(`<h3>${timeString}</h3>`);
};

const libModal = () => {
   let savedIP = localStorage.getItem("savedIP");
   window.ipMe = savedIP;
   if (!savedIP || savedIP === "") {
      $("#ipModal").modal("show");
   }

   $("#set-ipModal").val(savedIP);

   $("#videoPlayer").on("click", function () {
      $("#ipModal").modal("show");
   });

   $("#ip-content").on("click", function () {
      $("#ipModal").modal("show");
   });

   $("#save-setIp").click(function () {
      let ipAddress = $("#set-ipModal").val();
      localStorage.setItem("savedIP", ipAddress);
      successSwal("Success");
      $("#ipModal").modal("hide");
      location.reload();
   });
};

// chrome://flags/#enable-webrtc-hide-local-ips-with-mdns   buat disabled
function getLocalIP() {
   return new Promise(function (resolve, reject) {
      var RTCPeerConnection =
         /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection ||
         window.mozRTCPeerConnection;

      if (!RTCPeerConnection) {
         reject("Your browser does not support this API");
      }

      var rtc = new RTCPeerConnection({ iceServers: [] });
      var addrs = {};
      addrs["0.0.0.0"] = false;

      function grepSDP(sdp) {
         var hosts = [];
         var finalIP = "";
         sdp.split("\r\n").forEach(function (line) {
            if (~line.indexOf("a=candidate")) {
               var parts = line.split(" "), // http://tools.ietf.org/html/rfc5245#section-15.1
                  addr = parts[4],
                  type = parts[7];
               if (type === "host") {
                  finalIP = addr;
               }
            } else if (~line.indexOf("c=")) {
               // http://tools.ietf.org/html/rfc4566#section-5.7
               var parts = line.split(" "),
                  addr = parts[2];
               finalIP = addr;
            }
         });
         return finalIP;
      }

      if (1 || window.mozRTCPeerConnection) {
         rtc.createDataChannel("", { reliable: false });
      }

      rtc.onicecandidate = function (evt) {
         if (evt.candidate) {
            var addr = grepSDP("a=" + evt.candidate.candidate);
            resolve(addr);
         }
      };
      rtc.createOffer(
         function (offerDesc) {
            rtc.setLocalDescription(offerDesc);
         },
         function (e) {
            console.warn("offer failed", e);
         }
      );
   });
}

async function getIPAddress() {
   try {
      const ip = await getLocalIP();
      console.log("Local IP:", ip);
      return ip;
   } catch (error) {
      console.error(error);
   }
}

let voices = [];
let videoFiles = [];
let currentVideoIndex = 0;
let announcedNumbers = new Set();

const populateVoices = () => {
   voices = speechSynthesis.getVoices();
};

window.speechSynthesis.onvoiceschanged = populateVoices;

const getIp = () => {
   return new Promise((resolve) => {
      getDataList("antrian/ip", (res) => {
         let ipMe = window.ipMe;
         let results = res.value.data.filter(
            (item) => !item.display_room.includes("LOKET PENDAFTARAN")
         );

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

const initializeVideoPlayer = () => {
   const videoPlayer = document.getElementById("videoPlayer");
   videoPlayer.src = `assets/vidio/${videoFiles[currentVideoIndex]}`;
   videoPlayer.volume = 0.01;
   videoPlayer.addEventListener("ended", playNextVideo);
};

const playNextVideo = () => {
   currentVideoIndex = (currentVideoIndex + 1) % videoFiles.length;
   const videoPlayer = document.getElementById("videoPlayer");
   videoPlayer.src = `assets/vidio/${videoFiles[currentVideoIndex]}`;
   videoPlayer.volume = 0.01;
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
            console.warn(
               `No valid call time for data: ${JSON.stringify(data)}`
            );
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
   setInterval(updateClock, 1000);
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

// $("#poli-content").on("click", function () {
//    const queueData = $(this).data("queueData");
//    if (queueData) {
//       announceQueue(queueData);
//    }
// });

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
      successSwal("Success");
   };
   msg.onerror = () => {
      console.error("Error saat memutar suara.");
   };
   speechSynthesis.speak(msg);
};
