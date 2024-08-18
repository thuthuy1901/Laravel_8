$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// loadmore
function LoadMore() {
    const page = $("#page").val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { page },
        url: "/services/load-product",
        success: function (result) {
            if (result.html != "") {
                $("#LoadMore").append(result.html);
                $("#page").val(page + 1);
            } else {
                alert("Đã load xong sản phẩm!");
                $("#button-loadMore").css("display", "none");
            }
        },
    });
}
