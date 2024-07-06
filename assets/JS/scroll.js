document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.uk-navbar-nav a[data-section]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const sectionId = this.getAttribute('data-section');
            const section = document.getElementById(sectionId);
            
            if (section) {
                window.scrollTo({
                    top: section.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
});