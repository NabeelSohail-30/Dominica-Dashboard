function closeAlert() {
    const alert = document.querySelector(".alert");
    alert.style.display = "none";
}

function editMenu(menuId) {
    window.location.href = "/admin/edit_menu/" + btoa(menuId);
}

$(document).ready(function () {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Search functionality
    $("#search").on("keyup", function () {
        var searchTerm = $(this).val();
        var searchUrl = "/menus/search"; // Adjust URL if necessary

        // AJAX request
        $.ajax({
            url: searchUrl,
            type: "GET",
            data: { search: searchTerm },
            success: function (data) {
                // Update the table body with the returned data
                $("#menuTableBody").html(data);
            },
            error: function (xhr) {
                console.error("Search AJAX error:", xhr);
            },
        });
    });
});

function updateEntriesPerPage() {
    const entriesPerPage = document.getElementById("entriesPerPage").value;
    const url = new URL(window.location.href);
    url.searchParams.set("per_page", entriesPerPage);
    window.location.href = url.href;
}
