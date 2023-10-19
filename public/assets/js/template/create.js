$(document).ready(function() {  
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
    quill.on('text-change', function(delta, oldDelta, source) {
        if (source == 'api') {
            console.log("An API call triggered this change.");
        } else if (source == 'user') {
            let content = new String(quill.getContents().ops[0].insert);
            if (content == '\n') {
                $("#submit").removeClass("btn-primary").attr("disabled", "");
                $("#content").val("");
    
            } else {
                $("#submit").addClass("btn-primary").removeAttr("disabled");
                $("#content").val(quill.root.innerHTML);
            }
        }
    });
    
    $("form").submit(function(e) {
        e.preventDefault();
        message_add();
    })
    
    function message_add() {
        let title = $("#title").val().trim();
        let type = $("#type").val().trim();
        let trigger = $("#trigger").val().trim();
        let content = $("#content").val().trim();

        if(title == "" || type == "" || trigger == "" || content == ""){
            alert("内容を正確に入力してください。");
            return;
        }
        if( type == "sms"){
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
            function(data, status) {    
                if(status = 'success'){
                    window.location.href = "/template"
                }
            }
        )
    }

    $("#type").change(function(e){
        if(e.target.value == "sms"){
            $("#trigger option:nth-child(2)").hide();
        }else {
            $("#trigger option:nth-child(2)").show();
        }
    })

})