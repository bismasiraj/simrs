let voices = [];
let videoFiles = [];
let currentVideoIndex = 0;
let announcedNumbers = new Set();
let queueData = [];
let queueInterval;

$(document).ready(async function () {
   libModal();
   await getIp();
   getDataOne();
   checkVoiceAvailability();
   updateClock();
});

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

const updateClock = () => {
   const timeString = moment().format("DD MMM YYYY HH:mm:ss");
   $("#clock").html(`<h3>${timeString}</h3>`);
};

const populateVoices = () => {
   voices = speechSynthesis.getVoices();
};

window.speechSynthesis.onvoiceschanged = populateVoices;

const getIp = () => {
   return new Promise((resolve) => {
      getDataList("antrian/ip", (res) => {
         let ipMe = window.ipMe;
         let results = res.value.data.filter((item) =>
            item.display_room.includes("LOKET PENDAFTARAN")
         );

         let result = results.filter((item) => item?.display_ip === ipMe);
         window.loket = results.filter(
            (item) =>
               item.display_room &&
               item.display_room.includes("LOKET PENDAFTARAN")
         );
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
      $("#ip-content").show();
      $("#ip-content").html(`<h1>${window.ipMe}</h1>`);
      console.warn("No result data available");
      return;
   }

   $("#ip-content").hide();
   getDatapolis();
   pemanggilan_antrian();
   let result2 = "";
   let counter = 0;

   const sortedLoket = window.loket.sort((a, b) => {
      const aValue = a?.display_room.split("LOKET PENDAFTARAN ")[1];
      const bValue = b?.display_room.split("LOKET PENDAFTARAN ")[1];
      return aValue - bValue;
   });

   result2 += '<div class="row">';

   sortedLoket.forEach((item) => {
      if (counter % 3 === 0 && counter > 0) {
         result2 += '</div><div class="row">';
      }

      result2 += `<div class="col-md-4">
                          <div id="content-poli-${
                             item?.display_room.split("LOKET PENDAFTARAN ")[1]
                          }" class="queue-item-poli mt-3 fw-bold">
                              <h4 class="fw-bold">${item?.display_room
                                 .replace("PENDAFTARAN", "")
                                 .trim()} 
                                  <div style="font-size: 39px;"  id="${
                                     item?.display_room.split(
                                        "LOKET PENDAFTARAN "
                                     )[1]
                                  }-id" class="color-content-green text-danger"></div>
                              </h4>
                          </div>
                      </div>`;

      counter++;
   });

   result2 += "</div>";

   $("#groupe-content").html(result2);

   $("#queueDisplay").show();
   $("#trx-content").show();
   $("#poli-content").show();
   $("#poliSelect").parent().hide();
   $("#employeeSelect").parent().hide();
   $("#startButton").hide();
   $("#stopButton").show();
};

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

const displayQueue = (data) => {
   if (data) {
      console.log("ada data");

      $("#queueDisplay").html(`
           <h3 class="fw-bold" style=" font-size: 36px;" >NO ANTRIAN</h3>
           <h1 class="fw-bold" style="font-size: 155px;">${String(data.no_urut).padStart(3, "0")}</h1>
           <h2 class="fw-bold" style="font-size: 53px;">Loket ${data.loket}</h2>
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

   const text = `Nomor Antrian, ${String(data.no_urut)
      .padStart(3, "0")
      .replace(/([A-Z])(?=[A-Z])/g, "$1,")}, menuju loket , ${data.loket}`;
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
         visit_id: data.visit_id,
         id: `${data.id}`,
      },
      "pendaftaran/updateStatus",
      (res) => {
         console.log(res);
      }
   );
};

const getDatapolis = () => {
   getDataList("pendaftaran/getData", (res) => {
      res?.value?.display.map((e) => {
         $(`#${e.loket}-id`).html(`${e?.no_antrian ?? "000"}`);
      });
      if (res.respon === true && res.value.data.length > 0) {
         updateQueue(res.value.data);
      }
   });
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
