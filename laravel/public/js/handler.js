const confirmButtons = document.getElementsByClassName('confirmed');

Array.from(confirmButtons).forEach(button => {
    button.addEventListener('click', event => {
        const ok = window.confirm('Are you sure?');
        if (!ok) {
            event.preventDefault();
        }
    });
});

