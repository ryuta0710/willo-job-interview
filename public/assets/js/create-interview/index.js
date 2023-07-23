$(document).ready(function () {
	var quill = new Quill('#editor', {
		theme: 'snow'
	});
	quill.on('text-change', function (delta, oldDelta, source) {
		if (source == 'api') {
			console.log("An API call triggered this change.");
		} else if (source == 'user') {
			if (new String(quill.getContents().ops[0].insert) == '\n') {
				$("#next").removeClass("active").attr("disabled", "");

			} else {
				$("#next").addClass("active").removeAttr("disabled");
			}
		}
	});
	// company description
	$("#state_toggle").change(function () {
		$("#description_video").toggle(300)
		console.log($("#video_url").attr("disabled"));
		if ($("#video_url").attr("disabled") == "disabled") {
			$("#video_url").removeAttr("disabled");
		} else {
			$("#video_url").attr("disabled", "disabled");

		}
	})
	$(".step").click(function () {

	})
	$("#btn_upload").click(function () {
		$("#file_upload").click();
	})

	$("#file_upload").change(function(){
		$("#preview").html($("#file_upload").val())
	})

	// make questions
	let question_no = 1;
	$("#add_questioin").click(function () {
		let old = document.getElementById("question1");
		let newEle = old.cloneNode(true);
		$(this).before(newEle);
		question_no++;

		$(newEle).attr("data-no", question_no);
		$(newEle).attr("id", "question" + question_no)
			.find(".question-no").html(question_no);
	})

	// $(".up").click(function(){
	//   let par = $(this).parent().parent();
	//   let no = par.attr("data-no");
	//   no = parseInt(no);
	//   if(no>1){
	//     let temp=$(par).before();
	//     $(par).after(temp);
	//   }
	// alert(no)

	var steps = document.querySelectorAll("#steps .rounded-circle");
	$("#before").click(function () {
		var steps = document.querySelectorAll("#steps .rounded-circle");
		if ($("#description").css("display") != "none") {

		} else if ($("#questions").css("display") != "none") {
			$("#before").hide()
			$("#description").removeClass("none");
			$("#questions").addClass("none");
			steps[1].classList.remove("bg-active");

		} else if ($("#notification").css("display") != "none") {
			$("#questions").removeClass("none");
			$("#notification").addClass("none");
			steps[2].classList.remove("bg-active");
		} else if ($("#public").css("display") != "none") {
			$("#next").show();
			$("#btn_public").addClass("none");
			$("#notification").removeClass("none");
			$("#public").addClass("none");
			steps[3].classList.remove("bg-active");
		}
	})
	$("#next").click(function () {
		var steps = document.querySelectorAll("#steps .rounded-circle");
		if ($("#description").css("display") != "none") {
			$("#before").show()
			$("#description").addClass("none");
			$("#questions").removeClass("none");
			steps[1].classList.add("bg-active");
		} else if ($("#questions").css("display") != "none") {
			$("#questions").addClass("none");
			$("#notification").removeClass("none");
			steps[2].classList.add("bg-active");

		} else if ($("#notification").css("display") != "none") {
			$("#notification").addClass("none");
			$("#public").removeClass("none");
			$("#btn_public").removeClass("none");
			$(this).hide()
			steps[3].classList.add("bg-active");

		} else if ($("#public").css("display") != "none") {

		}
	})

	//data limit set
	let temp = "";
	let now = new Date();
	let end = new Date(now.getTime() + 1000 * 60 * 60 * 24 * 30)
	while (now.getTime() < end.getTime()) {
		now = new Date(now.getTime() + 1000 * 60 * 60 * 24)
		temp += "<option value='" + now.toString() + "'>" + now.getFullYear() + "年 " + (now.getMonth() + 1) + "月 " + now.getDate() + "日</option>"
	}
	$("#date_limit").prepend(temp);

	//copy
	function copy(text) {
		alert(text)
		navigator.clipboard.writeText(text);
	}

	$(".fa-copy").click(function (e) {
		$(e.target).toggleClass("text-primary");
	})
})
