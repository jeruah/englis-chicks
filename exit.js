document.addEventListener('DOMContentLoaded', () => {
    let isRedirecting = false;

    // Function to handle session destruction when the user closes the tab
    function handleSessionDestruction() {
        if (!isRedirecting) {
            navigator.sendBeacon('/PHP/logout.php');
        }
    }

    // Listen for the beforeunload event to detect when the user is about to leave the page
    window.addEventListener('beforeunload', handleSessionDestruction);

    // Listen for visibility change to detect when the page becomes hidden
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden') {
            handleSessionDestruction();
        }
    });

    // Set isRedirecting to true when a link is clicked
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            isRedirecting = true;
        });
    });

    // Set isRedirecting to true when a form is submitted
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
            isRedirecting = true;
        });
    });
});