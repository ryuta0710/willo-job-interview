$(document).ready(function () {

	//data limit set
	let temp = "";
	let now = new Date();
	let end = new Date(now.getTime() + 1000 * 60 * 60 * 24 * 30)
	while (now.getTime() < end.getTime()) {
		now = new Date(now.getTime() + 1000 * 60 * 60 * 24)
		temp += "<option value='" + now.toString() + "'>" + now.getFullYear() + "年 " + (now.getMonth() + 1) + "月 " + now.getDate() + "日</option>"
	}
	$("#date_limit").prepend(temp);
	func();
})

function func() {
	$(".answer_type").change(function (e) {
		$(e.target).parent().parent().parent().parent().attr("class", "card p-3 position-relative question active	");

		let val = e.target.value;

		switch (val) {
			case 'video':
				$(e.target).parents(".card").find(".dis_answer_type").html("ビデオ");
				$(e.target).parent().parent().parent().parent().addClass("question-video");
				break;
			case 'audio':
				$(e.target).parents(".card").find(".dis_answer_type").html("オーディオ");
				$(e.target).parent().parent().parent().parent().addClass("question-voice");
				break;
			case 'text':
				$(e.target).parents(".card").find(".dis_answer_type").html("文章");
				$(e.target).parent().parent().parent().parent().addClass("question-writing");
				break;
			case 'file':
				$(e.target).parents(".card").find(".dis_answer_type").html("ファイル");
				$(e.target).parent().parent().parent().parent().addClass("question-file");
				break;
			case 'ai':
				$(e.target).parents(".card").find(".dis_answer_type").html("AIチャット");
				$(e.target).parent().parent().parent().parent().addClass("question-ai");
				break;

			default:
				$(e.target).parents(".card").find(".dis_answer_type").html("ビデオ");
				$(e.target).parent().parent().parent().parent().addClass("question-video");
				break;
		}
	});

	$("#questions .card").click(function (e) {
		$(".card").removeClass("active");

		if ($(e.target).hasClass("card"))
			$(e.target).addClass("active");
		else
			$(e.target).parents(".card").addClass("active");

		e.preventDefault();
	});

	$(".retake").change(function (e) {
		if (e.target.value == "infinite") {
			$(e.target).parents(".card").find(".dis_retake").html("制限なし");
		} else {
			$(e.target).parents(".card").find(".dis_retake").html(e.target.value + "回");
		}
	});

	$(".time").change(function (e) {
		$(e.target).parents(".card").find(".dis_time").html(e.target.value);
		if (e.target.value == "infinite") {
			$($(e.target).parents(".card").find(".dis_time_minute")[0]).hide();

		} else {
			$($(e.target).parents(".card").find(".dis_time_minute")[0]).show();
		}
	});

	$(".limit").change(function (e) {
		if (e.target.value == "characters") {
			$(e.target).parents(".card").find(".dis_limit").html("文字");
		} else {
			$(e.target).parents(".card").find(".dis_limit").html("文章");
		}
	})

	$(".max").change(function (e) {
		let val = parseInt(e.target.value);
		if (val <= 0 || isNaN(val)) {
			e.target.value = 1;
			val=1;
		}
		$(e.target).parents(".card").find(".dis_max").html(val);

	})

	$(".thinking_hour").change(function (e) {
		let val = Number(e.target.value);
		if (isNaN(val) || val < 0) {
			e.target.value = 0;
			val = 0;
		}
		$(e.target).parents(".card").find(".dis_thinking_hour").html(val);
	})

	$(".thinking_minute").change(function (e) {
		let val = Number(e.target.value);
		if (isNaN(val) || val < 0) {
			e.target.value = 0;
			val = 0;
		}
		if (val > 59) {
			val = 59;
		}
		$(e.target).parents(".card").find(".dis_thinking_minute").html(val);
	});

	$(".q_content").keyup(function (e) {
		questions_check();
	})

	$("*").click(function (e) {
		if ($(e.target).parents(".card").length == 0) {
			$(".card").removeClass("active");
		}
		// console.log("sdf")
	});


}
// make questions
let old11 = document.getElementsByClassName("card")[0];
let newEle = old11.cloneNode(true);
$("#add_questioin").click(function () {
	let newEle1 = newEle.cloneNode(true);
	$(this).before(newEle1);
	func();

	copy();
	del();
	up();
	down();
	recount();
});

function questions_check() {
	let questions = document.getElementsByClassName("card");
	let length = questions.length;
	$("#next").removeAttr("disabled").addClass("active").removeClass("bg-secondary-subtle");

	for (let i = 0; i < length; i++) {

		let content = $(questions[i]).find('.q_content').val().trim();
		if (content == "") {
			$("#next").attr("disabled", "").removeClass("active").addClass("bg-secondary-subtle");
			return false;
		}
		// $.ajax({
		// 	url: url,
		// 	type: 'DELETE',
		// 	data: {
		// 		_token: $("meta[name=csrf-token]").attr("content"),
		// 	},
		// 	success: function(response) {
		// 		location.reload();
		// 	},
		// 	error: function(xhr, status, error) {
		// 		alert(xhr.responseJSON.message);
		// 	}
		// });

	}
	return true;
};