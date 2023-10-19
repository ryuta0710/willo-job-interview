$(document).ready(function () {

	// company description
	$("#state_toggle").change(function () {

		var checkbox = document.getElementById("state_toggle");

		if (checkbox.checked) {
			$("#video_url").attr("disabled", "");
			$("#description_video").slideDown(500);
		} else {
			$("#video_url").removeAttr("disabled");
			$("#description_video").slideUp(500);
		}
	});

	$(".step").click(function () {

	});

	$("#btn_upload").click(function (e) {
		e.preventDefault();
		$("#file_upload").click();
	})
});


async function record() {
	const videoLive = document.querySelector('#videoLive')
	const videoRecorded = document.querySelector('#videoRecorded')
	let stream;

	try {
		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			await navigator.mediaDevices.getUserMedia({
				video: true,
				audio: true,
			}).then(function (sss) {
				stream = sss;

				videoLive.srcObject = stream

				if (!MediaRecorder.isTypeSupported('video/webm')) { // <2>
					console.warn('video/webm is not supported')
				}

				const mediaRecorder = new MediaRecorder(stream, { // <3>
					mimeType: 'video/webm',
				})

				mediaRecorder.start()
				recording = true;
				$("#record").html('録音を停止')

				$("#record").click(function (e) {
					e.preventDefault();

					if (!recording) {
						mediaRecorder.start() // <4>
						$("#record").html('録音を停止')
						$("#videoLive").show();
						$("#videoRecorded").hide();

					} else {
						mediaRecorder.stop()
						$("#record").html('録音を閧始')
						$("#videoLive").hide();
						$("#videoRecorded").show();

					}
					recording = !recording;
				})


				mediaRecorder.addEventListener('dataavailable', event => {
					videoRecorded.src = URL.createObjectURL(event.data) // <6>
				})
			}).catch(function (res) {
				console.log(res);
				alert("カメラを接続してください。")
			})
		} else {
			console.error('getUserMedia()はサポートされていません。\n httpsで接続してください。');
		}

	} catch (e) {
		alert("現在、規約ではサポートしていません。httpsで接続してください。")
	}


}
let flag = true;

$("#record").click(function (e) {
	e.preventDefault();
	if (flag) {
		record();
		flag = false;
	}
})