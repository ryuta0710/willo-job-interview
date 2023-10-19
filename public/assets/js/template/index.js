$(document).ready(function () {
    $("#messages_table [data-bs-toggle=modal]").click(function (e) {
        e.preventDefault();
        const id = $(e.currentTarget).attr("data-id");
        const modal_name = $(e.currentTarget).attr("data-bs-target");
        $.ajax({
            url: '/template/' + id,
            type: 'GET',
            data: {
                _token: $("meta[name=csrf-token]").attr("content"),
            },
            success: function (response) {
                try {
                    $(modal_name + " .message-content").html(response.content);
                    $(modal_name + " .modal-title").html(response.title);
                } catch (e) {
                    window.location.reload();
                }
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON.message == "Unauthenticated") {
                    window.location.reload();
                }
                alert(xhr.responseJSON.message);
            }
        });
    });
})

function del(id) {
    $.ajax({
        url: '/template/' + id,
        type: 'DELETE',
        data: {
            _token: $("meta[name=csrf-token]").attr("content"),
        },
        success: function (response) {
            location.reload();
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON.message == "Unauthenticated") {
                window.location.reload();
            }
            alert(xhr.responseJSON.message);
        }
    });
}
function copy(id) {
    $.ajax({
        url: '/template/' + id + "/copy",
        type: 'post',
        data: {
            _token: $("meta[name=csrf-token]").attr("content"),
        },
        success: function (response) {
            location.reload();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseJSON.message);
        }
    });
}
$("#search_content, #search_type").change(function () {
    search_job();
});

function search_job() {
    const keyword = $("#search_content").val().trim();
    let type = $("#search_type").val();
    $.ajax({
        url: '/template/search',
        type: 'POST',
        data: {
            _token: $("meta[name=csrf-token]").attr("content"),
            keyword,
            type,
        },
        success: function (response) {
            let dis = "";
            response.forEach(ele => {
                const type = ele.type == "email" ? `<i class="fa fa-solid fa-envelope me-2"></i> ` : `<i class="fa fa-solid fa-comment me-2"></i> `;
                let modal = "";
                if (ele.type == 'sms') {
                    modal = ` data-bs-target="#smsModal"`;
                };
                if (ele.type == 'email' && ele.trigger == 'invite') {
                    modal = ` data-bs-target="#inviteModal"`;
                };
                if (ele.type == 'email' && ele.trigger == 'success') {
                    modal = ` data-bs-target="#successModal"`;
                };
                if (ele.type == 'email' && ele.trigger == 'reminder') {
                    modal = ` data-bs-target="#reminderModal"`;
                };
                const btnEdit = ele.editable == 1 ? `<a href="/template/${ele.id}/edit"> <i class="fa fa-solid fa-edit me-3"></i> </a>` : `<div style="display: inline-block;width: 32px;"></div>`;
                const btnDel = ele.editable == 1 ? `<a href="javascript:;" onclick="del('${ele.id}')"> <i class="fa fa-solid fa-trash"></i> </a>` : ` <div style="display: inline-block;width: 14px;height: 1rem;"></div>`;
                const text = ele.content.replace(/<[^>]+>/g, '');
                const date = new Date(ele.updated_at);
                const formattedDate = date.toLocaleDateString('ja', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\//g, '-');

                dis += `<tr>
                <td>${type}${ele.title}</td>
                <td>${formattedDate}</td>
                <td>${text}</td>
                <td>
                    <div>
                        <a href="javascript:;" data-bs-toggle="modal" data-id="${ele.id}"${modal}>
                            <i class="fa fa-solid fa-eye me-3"></i>
                            </a> ${btnEdit}
                            <a href="javascript:;" onclick="copy('${ele.id}')">
                                <i class="fa fa-solid fa-copy me-3"></i>
                            </a> ${btnDel}
                    </div>
                </td>
            </tr>`;
            });
            $("#tbody").html(dis);
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON.message == "Unauthenticated") {
                window.location.reload();
            }
            alert(xhr.responseJSON.message);
        }
    });
    $("#filter_clear").click(function () {
        window.location.reload();
    })
}