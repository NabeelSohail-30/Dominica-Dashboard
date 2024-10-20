// document
//     .querySelector(".slider-icon a")
//     .addEventListener("click", function (e) {
//         e.preventDefault();

//         const sidebar = document.querySelector(".sidebar");
//         const caretIcon = document.querySelector(".caret");

//         // Toggle the sidebar collapsed class
//         sidebar.classList.toggle("sidebar-collapsed");

//         // Check if the sidebar is collapsed and rotate the icon accordingly
//         if (sidebar.classList.contains("sidebar-collapsed")) {
//             caretIcon.style.transform = "rotate(180deg)";
//         } else {
//             caretIcon.style.transform = "rotate(0deg)";
//         }
//     });

document.addEventListener("DOMContentLoaded", function () {
    const sliderIcon = document.querySelector(".slider-icon a");
    const sidebar = document.querySelector(".sidebar");
    const caretIcon = document.querySelector(".caret");
    const footer = document.querySelector(".form-footer"); // Only target pages with a footer
    const main = document.querySelector(".main");

    if (sliderIcon && sidebar && caretIcon) {
        sliderIcon.addEventListener("click", function (e) {
            e.preventDefault();

            // Toggle the sidebar collapsed class
            sidebar.classList.toggle("sidebar-collapsed");

            // Check if the sidebar is collapsed and rotate the icon accordingly
            if (sidebar.classList.contains("sidebar-collapsed")) {
                caretIcon.style.transform = "rotate(180deg)";

                // If footer exists, adjust its width when sidebar is collapsed
                if (footer) {
                    footer.style.left = "60px";
                    footer.style.width = "calc(100% - 60px)";
                }

                if (main) {
                    main.style.marginLeft = "60px";
                    main.style.width = "calc(100% - 60px)";
                }
            } else {
                caretIcon.style.transform = "rotate(0deg)";

                // If footer exists, adjust its width when sidebar is expanded
                if (footer) {
                    footer.style.left = "20%";
                    footer.style.width = "80%";
                }

                if (main) {
                    main.style.marginLeft = "20%";
                    main.style.width = "80%";
                }
            }
        });
    }
});
