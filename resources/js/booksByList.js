document.querySelectorAll('.list-item').forEach(item => {
    item.addEventListener('click', function () {
        const listId = this.dataset.listId;
        var booksContainer = document.getElementById('my-books-container');
        fetch(`/lists/${listId}/books`)
            .then(response => response.text())
            .then(data => {
                booksContainer.innerHTML = data;
            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });
    });
});