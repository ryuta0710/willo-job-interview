$(document).ready(async function () {

  // TAB FUNCTIONvar 

  var plaryer = new Plyr('video.videoRecorded', {
    muted: false,
    volume: 1,
    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
  });
  

  $('.no-group a').click(function() {
    var tab_id = $(this).attr('data-tab');
    console.log(question_id)
    $('.no-group a').removeClass('active');
    $('.tab-content').removeClass('active');

    let elements = document.querySelectorAll(".no-group a");
    let len = elements.length;
    for (let i = 0; i < len; i++) {
        elements[i].classList.add("active");
        if (elements[i] == this) {
            break;
        }
    }
    $(this).addClass('active');
    $("#" + tab_id).addClass('active');
});
  $("#save_continue").click(function () {
    $("#tab-1").removeClass("active");
    $("#tab-2").addClass("active");
    elements = document.querySelectorAll(".no-group a");
    for (let i = 0; i < 2; i++) {
      elements[i].classList.add("active");
    }
  })

  $(".btn_upload").click(function (e) {
    $("#fileupload").click();

  })

  $("#fileupload").change(function (e) {
    $(".file_preview").html(e.target.value)
  })

  $("#go_interview").click(function () {
    $("#welcome_message").addClass("d-none");
    $("#test").removeClass("d-none");
  })


  // WHEN FINISH BUTTON IS PRESSED
  $("#test_finish").click(function () {
    // IDENTIFY IF TEST IS FINISHED


    // IF TEST CAN BE FINISHED
    $(".test-flow").hide();
    $(".test-content").hide();

    // $(".test-complete").show();
    $(".test-complete").removeClass("d-block").addClass("d-none");
    $(".test-complete").removeClass("d-none").addClass("d-block");

  })





  $("#answer_confirm").click(function () {
    // $(".test-complete").hide();
    // $(".meeting-book").show();
    $(".test-complete").removeClass("d-block").addClass("d-none");
    $(".meeting-book").removeClass("d-none").addClass("d-block");
  })

  // VIDEO RECODING

  let videoRecordingState = false;
  let preview = document.getElementById("preview");
  let recording = document.getElementById("recording");
  let startButton = document.getElementById("videoRecord");
  // let stopButton = document.getElementById("stopButton");
  // let downloadButton = document.getElementById("downloadButton");
  // let logElement = document.getElementById("log");

  let recordingTimeMS = 5000;

  function startRecording(stream, lengthInMS) {

    if (!videoRecordingState) {
      let recorder = new MediaRecorder(stream);
      let data = [];

      recorder.ondataavailable = (event) => data.push(event.data);
      recorder.start();
      log(`${recorder.state} for ${lengthInMS / 1000} seconds…`);

      let stopped = new Promise((resolve, reject) => {
        recorder.onstop = resolve;
        recorder.onerror = (event) => reject(event.name);
      });

      let recorded = wait(lengthInMS).then(() => {
        if (recorder.state === "recording") {
          recorder.stop();
        }
      });

      return Promise.all([stopped, recorded]).then(() => data);

    }
    else {
      stream.getTracks().forEach((track) => track.stop());
    }
    videoRecordingState = !videoRecordingState;

  }


})