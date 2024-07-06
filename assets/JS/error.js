import UIkit from 'uikit';

document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Empêche la soumission normale du formulaire

            fetch('/', {
                method: 'POST',
                body: new FormData(contactForm)
            })
                .then(res => res.json())
                .then(data => {
                    // Clear previous errors
                    document.querySelectorAll('.form-error').forEach(el => el.textContent = '');

                    if (data.status_mail === 'success') {
                        UIkit.notification({ message: data.message_success, status: 'success', pos: 'top-right' });
                        setTimeout(() => {
                            window.location.reload();
                        }, 4000);
                    } else if (data.status_mail === 'warning') {
                        UIkit.notification({ message: data.message_error, status: 'warning', pos: 'top-right' });
                    } else if (data.status_mail === 'error') {
                        UIkit.notification({ message: data.message_error, status: 'warning', pos: 'top-right' });                        
                        for (const [field, message] of Object.entries(data.errors)) {
                            const errorElement = document.getElementById(`${field}-error`);
                            if (errorElement) {
                                errorElement.textContent = message;
                            } else {
                                console.error(`No error element found for ${field}`);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
});
