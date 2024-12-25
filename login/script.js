document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage = document.getElementById('errorMessage');

    // Simple validation
    if (username === '' || password === '') {
        errorMessage.textContent = 'Please fill out all fields.';
    } else if (username === 'admin' && password === '1234') {
        errorMessage.style.color = 'green';
        errorMessage.textContent = 'Login successful!';
    } else {
        errorMessage.textContent = 'Invalid username or password.';
    }
});
