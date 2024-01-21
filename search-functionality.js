$(document).ready(function () {
    let searchBarTimeout;
    let unsavedText = false;

    $("#searchIcon").hover(function () {
        $("#searchInput").addClass("active");
        $("#searchInput").focus();
        startTimeoutToCloseSearchBar();
    });

    $("#searchInput").on("input", function () {
        clearTimeout(searchBarTimeout);
        showSearchButton();
        showClearButton();
        unsavedText = true;
    });

    $("#searchButton").on("click", function () {
        triggerSearchFunctionality();
    });

    $("#clearTextButton").on("click", function () {
        clearEnteredText();
    });

    window.addEventListener("beforeunload", function () {
        handleUnsavedTextPrompt();
    });

    function startTimeoutToCloseSearchBar() {
        searchBarTimeout = setTimeout(function () {
            if ($("#searchInput").val().length === 0) {
                closeSearchBar();
            }
        }, 10000);
    }

    function closeSearchBar() {
        $("#searchInput").removeClass("active");
        $("#searchButton").hide();
        $("#clearTextButton").hide();
    }

    function showSearchButton() {
        $("#searchButton").show();
    }

    function showClearButton() {
        $("#clearTextButton").show();
    }

    function triggerSearchFunctionality() {
        // Your code to handle search functionality
    }

    function clearEnteredText() {
        $("#searchInput").val("");
        $("#searchButton").hide();
        $("#clearTextButton").hide();
    }

    function handleUnsavedTextPrompt() {
        if (unsavedText) {
            const confirmation = confirm("You have unsaved text. Are you sure you want to leave?");
            if (!confirmation) {
                return false; // Prevent leaving the page or refreshing
            }
        }
    }
});
