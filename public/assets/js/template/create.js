$(document).ready(function () {
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'ここに書いてください。',
        formarts: ['cus'],
        modules: {
            toolbar:
            {
                container: '#toolbar',
            },
        }
    });
    quill.on('text-change', function (delta, oldDelta, source) {
        if (source == 'api') {
            console.log("An API call triggered this change.");
        } else if (source == 'user') {
            let content = new String(quill.getContents().ops[0].insert);
            if (content == '\n') {
                $("#submit").removeClass("btn-primary").addClass("btn-secondary").attr("disabled", "");
                $("#content").val("");

            } else {
                $("#submit").addClass("btn-primary").removeClass("btn-secondary").removeAttr("disabled");
                $("#content").val(quill.root.innerHTML);
            }
        }
    });

    $("form").submit(function (e) {
        e.preventDefault();
        message_add();
    })

    function message_add() {
        let title = $("#title").val().trim();
        let type = $("#type").val().trim();
        let trigger = $("#trigger").val().trim();
        let content = $("#content").val().trim();

        if (title == "" || type == "" || trigger == "" || content == "") {
            toastr.error('内容を正確に入力してください。');
            return;
        }
        if (type == "sms") {
            content = new String(quill.getContents().ops[0].insert);
        }

        let token = $("meta[name=csrf-token]").attr("content");

        let postData = {
            _token: token,
            title,
            type,
            trigger,
            content,
        }
        $.post(
            "/template",
            postData,
            function (data, status) {
                if (status = 'success') {
                    window.location.href = "/template";
                }
            }
        )
    }

    $("#type").change(function (e) {
        if (e.target.value == "sms") {
            $("#trigger option:nth-child(2)").hide();
        } else {
            $("#trigger option:nth-child(2)").show();
        }
    });

    $("select#insert_var").change(function (e) {
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, `{${e.target.value}}`);
        console.log()
    });

    $("#showModal").click(function () {
        const type = $("#type").val();
        const trigger = $("#trigger").val();
        if (type == "email" && trigger == "success") {
            const myModal = new bootstrap.Modal(document.getElementById('successModal'), {});
            $("#successModal .message-content").html(quill.root.innerHTML);
            $("#successModal .modal-title").html($("#title").val());
            myModal.show();
        } else if (type == "email" && trigger == "invite") {
            const myModal = new bootstrap.Modal(document.getElementById('inviteModal'), {});
            $("#inviteModal .message-content").html(quill.root.innerHTML);
            $("#inviteModal .modal-title").html($("#title").val());
            myModal.show();
        } else if (type == "email" && trigger == "reminder") {
            const myModal = new bootstrap.Modal(document.getElementById('reminderModal'), {});
            $("#reminderModal .message-content").html(quill.root.innerHTML);
            $("#reminderModal .modal-title").html($("#title").val());
            myModal.show();
        } else if (type == "sms") {
            const myModal = new bootstrap.Modal(document.getElementById('smsModal'), {});
            $("#smsModal .message-content").html(quill.root.innerHTML);
            $("#reminderModal .modal-title").html($("#title").val());
            myModal.show();
        }
    })

})