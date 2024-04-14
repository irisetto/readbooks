
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
            alert(data.message);
        })
        .catch(error => {
            console.error('A apărut o eroare:', error);
        });
    });
});
