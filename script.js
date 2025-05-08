function showForm(formId) {
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}

const errorMessage = document.getElementById('error-message');
const newPassword = document.getElementById('new-password');
const confirmPassword = document.getElementById('confirm-password');
const changePasswordButton = document.getElementById('change-password-button');

// Clear error when typing
newPassword.addEventListener('input', () => {
    errorMessage.style.display = 'none';
});

confirmPassword.addEventListener('input', () => {
    errorMessage.style.display = 'none';
});

// Check passwords when clicking "Change Password"
changePasswordButton.addEventListener('click', () => {
    if (newPassword.value !== confirmPassword.value) {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Passwords do not match!';
    } else {
        errorMessage.style.display = 'none';
        alert('Password is successfully changed');
        // Add logic here to update the password in your database/system
    }
});
   
/* Clear Error & Success alert when the user starts typing in the password fields

document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const errorMessage = document.querySelector('.error-message');
            const successMessage = document.querySelector('.success-message');
            if (errorMessage) {
                errorMessage.remove();
            }
            if (successMessage) {
                successMessage.remove();
            }
        });
    });
}); 
*/