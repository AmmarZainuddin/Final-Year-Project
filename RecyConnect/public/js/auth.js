// Authentication Pages JavaScript
// Password toggle and form validation

document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    // Toggle password visibility
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = document.getElementById('toggleIcon');
            if (icon) {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        });
    }

    // Toggle confirm password visibility
    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            const icon = document.getElementById('toggleConfirmIcon');
            if (icon) {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        });
    }

    // Password match validation for signup form
    const signupForm = document.getElementById('signupForm');
    if (signupForm && passwordInput && confirmPasswordInput) {
        signupForm.addEventListener('submit', function(e) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                e.preventDefault();
                alert('Passwords do not match. Please try again.');
                confirmPasswordInput.focus();
                return false;
            }

            if (passwordInput.value.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long.');
                passwordInput.focus();
                return false;
            }
        });

        // Real-time password match indicator
        [passwordInput, confirmPasswordInput].forEach(input => {
            input.addEventListener('input', function() {
                if (confirmPasswordInput.value && passwordInput.value) {
                    if (passwordInput.value === confirmPasswordInput.value) {
                        confirmPasswordInput.classList.remove('is-invalid');
                        confirmPasswordInput.classList.add('is-valid');
                    } else {
                        confirmPasswordInput.classList.remove('is-valid');
                        confirmPasswordInput.classList.add('is-invalid');
                    }
                }
            });
        });
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});