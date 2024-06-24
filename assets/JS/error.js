import UIkit from 'uikit';

document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            event.preventDefault();

            fetch('/', {
                method: 'POST',
                body: new FormData(contactForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Indique une requête AJAX à Symfony
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status_mail === 'success') {

                        UIkit.notification({ message: data.message_success, status: data.status_mail, pos: 'top-right' });

                        setTimeout(() => {
                            window.location.reload()
                        }, 2200);
                    }

                    if (data.status_mail === 'errors') {
                        UIkit.notification({ message: data.message_error, status: data.status_mail, pos: 'top-right' });
                        window.location.reload()
                    }
                })

        });
    }
});
