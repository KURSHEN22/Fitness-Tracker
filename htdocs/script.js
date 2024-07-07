document.addEventListener('DOMContentLoaded', function () {
    // Form Validation on Submit
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (username === '' || password === '') {
            alert('Please fill out both fields.');
            event.preventDefault(); // Prevent form submission
        }
    });

    // Live Validation Feedback
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    usernameInput.addEventListener('input', function () {
        if (usernameInput.value.trim() === '') {
            usernameInput.setCustomValidity('Username cannot be empty.');
        } else {
            usernameInput.setCustomValidity('');
        }
    });

    passwordInput.addEventListener('input', function () {
        if (passwordInput.value.trim() === '') {
            passwordInput.setCustomValidity('Password cannot be empty.');
        } else {
            passwordInput.setCustomValidity('');
        }
    });

    // Password Visibility Toggle
    const togglePasswordButton = document.createElement('button');
    
    togglePasswordButton.type = 'button';
    togglePasswordButton.textContent = 'Show Password';
    passwordInput.parentElement.appendChild(togglePasswordButton);
    
    togglePasswordButton.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordButton.textContent = 'Hide Password';
        } else {
            passwordInput.type = 'password';
            togglePasswordButton.textContent = 'Show Password';
        }
    });
});
