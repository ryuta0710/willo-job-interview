
var quill = new Quill('#editor', {
    theme: 'snow'
});
quill.on('text-change', function(delta, oldDelta, source) {
    if (source == 'api') {
        console.log("An API call triggered this change.");
    } else if (source == 'user') {
        let content = new String(quill.getContents().ops[0].insert)
        if (content == '\n') {
            $("#save").removeClass("bg-primary").attr("disabled", "");

        } else {
            $("#save").addClass("bg-primary").removeAttr("disabled");
            $("#content").val(content);
        }
    }
});

$("form").submit(function(e) {
    e.preventDefault();
    message_add();
})

function message_add() {
    let title = $("#title").val();
    let type = $("#type").val();
    let trigger = $("#trigger").val();
    let content = $("#content").val();
    let token = $("meta[name=csrf-token]").attr("content")

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
        function(data, status) {
            console.log(data, status);
            if(status = 'success'){
                window.location.href = "/template"
            }
        }
    )
}