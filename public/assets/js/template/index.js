$(document).ready(function () {
    $("#messages_table [data-bs-toggle=modal]").click(function (e) {
        e.preventDefault();
        const id = $(e.currentTarget).attr("data-id");
        const modal_name = $(e.currentTarget).attr("data-bs-target");
        $.get(
            "/template/" + id,
            function (data, status) {
                if (status == "success") {
                    $(modal_name + " .message-content").html(data.content);
                    $(modal_name + " .modal-title").html(data.title);
                } else {

                }
            }
        )
    })

    function copy() {
        let doms = document.getElementsByClassName("fa-copy");
        let len = doms.length;
        for (let i = 0; i < len; i++) {
            doms[i].onclick = copy_set;
        }
    }

    function copy_set(e) {
        let dom = e.target.parentElement.parentElement.parentElement.parentElement;
        let new_dom = dom.cloneNode(true);
        dom.insertAdjacentElement("afterend", new_dom);

        // show();
        copy();
        del();
    }

    function del() {
        let doms = document.getElementsByClassName("fa-trash");
        let len = doms.length;
        for (let i = 0; i < len; i++) {
            doms[i].onclick = delete_set;
        }
    }

    function delete_set(e) {
        e.target.parentElement.parentElement.parentElement.parentElement.remove();
    }

    copy();
    del();


})