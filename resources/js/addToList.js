
document.querySelectorAll('.add-to-list').forEach(button => {
    button.addEventListener('click', function() {
        const bookId = this.dataset.bookId;

        fetch(`/add-to-list/${bookId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },

        })
        .then(response => response.json())
        .then(data => {
            // if (data.error) {
            //     // Afisăm notificarea de eroare în pagina books.blade.php
            //     const errorNotification = document.createElement('div');
            //     errorNotification.classList.add('alert', 'alert-danger');
            //     errorNotification.textContent = data.error;
            //     document.getElementById('notification').appendChild(errorNotification);
            // } 
                })
        .catch(error => {
            console.error('A apărut o eroare:', error);
        });
    });
});
