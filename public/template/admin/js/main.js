$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function removeRow(id, url) {
    console.log(1);
    if (confirm("Bạn muốn xóa?")) {
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert("Xóa lỗi!");
                }
            },
        });
    }
}

// upload file
$("#upload").change(function () {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        dataType: "JSON",
        data: form,
        url: "/admin/upload/services",
        success: function (results) {
            if (results.error == false) {
                $("#image_show").html(
                    '<a href="' +
                        results.url +
                        '" target="_blank"><img src="' +
                        results.url +
                        '" width="100px"/></a>'
                );
                $("#thumb").val(results.url);
            } else {
                alert("Up file lỗi!");
            }
        },
    });
});
