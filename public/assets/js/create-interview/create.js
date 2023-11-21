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

	$("#btn_upload").click(function (e) {
		e.preventDefault();
		$("#file_upload").click();
	})
});


const videoLive = document.querySelector('#videoLive')
const videoRecorded = document.querySelector('#videoRecorded')
let stream;
let recording = false;
let mediaRecorder;
let chunks = [];
async function record() {
	chunks = [];
	$("#record").removeAttr("disabled");
	$("#record").html('録音を停止')
	$("#videoLive").show();
	$("#videoRecorded").hide();
	recording = true;

	try {
		await navigator.mediaDevices.getUserMedia({
			video: true,
			audio: true,
		}).then(function (sss) {
			recording = true;
			stream = sss;
			videoLive.srcObject = stream;

			mediaRecorder = new MediaRecorder(stream, { // <3>
				mimeType: 'video/webm',
			});
			mediaRecorder.start();
			mediaRecorder.addEventListener('dataavailable', event => {
				chunks.push(event.data);
				videoRecorded.src = URL.createObjectURL(event.data) // <6>
			});
		}).catch(function (res) {
			console.log(res);
			toastr.error('カメラを接続してください。');
		})

	} catch (e) {
		toastr.error('現在、規約ではサポートしていません。httpsで接続してください。');
	}


}

$("#record").click(function (e) {
	e.preventDefault();
	if (recording) {
		mediaRecorder?.stop();
		$("#record").html('録音を閧始');
		$("#videoLive").hide();
		$("#videoRecorded").show();
		makeLink();
		recording = false;
	} else {
		counter();
		$("#record").attr("disabled", "");
		setTimeout(record, 3000);
	}
})

function counter() {
	let s = 3;
	$("#videoRecord").attr("disabled", "").addClass("bg-secondary-subtle");
	$("#counter").removeClass("d-none");
	$("#counter .counter-no").html(3);
	const timer = setInterval(() => {
		s--;
		$("#counter .counter-no").html(s);
		if (s == 0) {
			clearInterval(timer);
			$("#counter").addClass("d-none");
			$("#videoRecord").removeAttr("disabled").removeClass("bg-secondary-subtle");;
		}
	}, 1000);
}

function makeLink() {
	let blob = new Blob(chunks, { "type": "video/webm" });
	var input = document.querySelector('#file_upload'); //the file input
	var file = new File(blob, 'video_file.mp4'); // create new file
	
	var datTran = new ClipboardEvent('').clipboardData || new DataTransfer(); 
	datTran.items.add(file);  // Add the file to the DT object
	input.files = datTran.files;
}
