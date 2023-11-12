// Use AJAX to execute a PHP script
const xhr = new XMLHttpRequest();
xhr.open('GET', 'script.php', true);

xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 300) {
        // PHP script executed successfully, handle the response
        document.getElementById('response').textContent = xhr.responseText;
    } else {
        // Error handling
        console.error('Request failed with status:', xhr.status);
    }
};

xhr.onerror = function() {
    // Network error handling
    console.error('Request failed');
};

xhr.send();

