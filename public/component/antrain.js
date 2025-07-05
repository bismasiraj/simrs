$(document).ready(async function () {
   libModal();
   await getIp();
   getDataOne();
   checkVoiceAvailability();
   updateClock();
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
         let results = res.value.data.filter(
            (item) => !item.display_room.includes("LOKET PENDAFTARAN")
         );

         let result = results.filter((item) => item?.display_ip === ipMe);
         
         videoFiles = res.value.vidio;
         window.vidio = res.value.vidio;
         window.resultData = result


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
   videoPlayer.muted = true;
   videoPlayer.addEventListener("ended", playNextVideo);
};

const playNextVideo = () => {
   currentVideoIndex = (currentVideoIndex + 1) % videoFiles.length;
   const videoPlayer = document.getElementById("videoPlayer");
   videoPlayer.src = `assets/vidio/${videoFiles[currentVideoIndex]}`;
   videoPlayer.muted = true;
};

const getDataOne = () => {
   if (!window.resultData || window.resultData.length === 0) {
      $("#ip-content").show().html(`<h1>${window.ipMe}</h1>`);
      console.warn("No result data available");
      return;
   }

   const matchingData = window.resultData.filter(item => item.display_ip === window.ipMe);

   if (matchingData.length === 0) {
      $("#ip-content").show().html(`<h1>${window.ipMe}</h1>`);
      console.warn("No matching IP found");
      return;
   }

   $("#ip-content").hide();
   getDatapolis();
   pemanggilan_antrian();

   const poliContent = matchingData.map(data => `
      <div class="poli-item">
         <h1 class="fw-bold">${data.name_of_clinic.toUpperCase()}</h1>
         <h3 class="fw-bold">${data.fullname}</h3>
      </div>
   `).join("");

   $("#poli-content").html(poliContent);

   $("#queueDisplay, #trx-content, #poli-content").show();
   $("#poliSelect, #employeeSelect").parent().hide();
   $("#startButton").hide();
   $("#stopButton").show();
};


let queueData = [];
let queueInterval;
const updateQueue = (newData) => {
   if (newData.length > 0) {
      queueData.push(newData[0]);
      announceQueue(newData[0]);
      displayQueue(newData[0]);

      // newData.forEach((data) => {
      //    console.log(data);
      //    const callTime = new Date(data?.tanggal_panggil);

      //    if (!isNaN(callTime.getTime())) {
      //       if (callTime > tenSecondsAgo) {
      //          queueData.push(data);
      //          displayQueue();
      //          announceQueue(data);
      //          announcedNumbers.add(data.no_tiket);
      //          // $("#poli-content").data("queueData", data).trigger("click");
      //       }
      //    } else {
      //       console.warn(
      //          `No valid call time for data: ${JSON.stringify(data)}`
      //       );
      //    }
      // });
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

   // setTimeout(() => {
   //    if (!speechExecuted) {
   //       console.warn("Reload");
   //       announceQueue(data);
   //    }
   // }, 1000);

   speechSynthesis.speak(msg); // Mulai ucapan
   postData(
      {
         visit_id: `${data.visit_id}`,
         id: `${data.id}`,
      },
      "antrian/updateStatus",
      (res) => {
         console.log(res);
      }
   );
};

const getDatapolis = () => {
   let selectedPoliId = window.resultData[0]?.clinic_id;
   let selectedEmployeeIds = window.resultData.map((item) => item.employee_id); 

   postData(
      {
         poli: selectedPoliId,
         employees: selectedEmployeeIds, 
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
   setInterval(() => getDatapolis(), 10000);
   setInterval(updateClock, 1000);
};
const checkVoiceAvailability = () => {
   setInterval(() => {
      if (voices.length === 0) {
         populateVoices();
      }
   }, 3000);
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

      // videoPlayer.play();
      videoPlayer
         .play()
         .then(() => {
            successSwal("Success");
         })
         .catch((error) => {
            console.error("Error playing video:", error);
            alert("Video gagal diputar. Silakan cek konfigurasi browser.");
         });
      successSwal("Success");
   };
   msg.onerror = () => {
      console.error("Error saat memutar suara.");
   };
   speechSynthesis.speak(msg);
};
