// notification.js

$(document).ready(function() {
    // Function to display notification
    window.showNotification = function(message, type) {
        var notification = $('#notification');
        notification.text(message);  // Set the message

        // Log to check if the function is being called
        console.log("Notification:", message, "Type:", type);

        // Apply 'error' class for error notifications
        if (type === 'error') {
            notification.addClass('error');
        } else {
            notification.removeClass('error');
        }

        // Show notification with fade in/out
        notification.fadeIn(300).delay(3000).fadeOut(300);
    };
});
