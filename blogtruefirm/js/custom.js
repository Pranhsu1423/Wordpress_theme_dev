
document.addEventListener("DOMContentLoaded", function() {
    // Get all the tabs
    var tabs = document.querySelectorAll(".tab");
    var contents = document.querySelectorAll(".content");

    // Hide all tab content except the first one
    contents.forEach(function(content, index) {
        if (index !== 0) content.style.display = "none";
    });

    // Add event listener to each tab
    tabs.forEach(function(tab) {
        tab.addEventListener("click", function(e) {
            e.preventDefault();
            var tabId = this.getAttribute("data-tab");

            // Hide all contents
            contents.forEach(function(content) {
                content.style.display = "none";
            });

            // Remove active class from all tabs
            tabs.forEach(function(tab) {
                tab.classList.remove("active");
            });

            // Show the clicked tab content
            document.getElementById(tabId).style.display = "block";

            // Set the clicked tab as active
            this.classList.add("active");
        });
    });
});