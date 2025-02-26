document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.view-button');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const details = this.nextElementSibling;
            details.style.display = details.style.display === 'block' ? 'none' : 'block';
        });
    });
});
