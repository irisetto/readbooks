
document.addEventListener('DOMContentLoaded', function() {

var dropdownItems = document.querySelectorAll('.add-to-list');

dropdownItems.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        const bookId = this.dataset.bookId;
        const listId = this.dataset.listId;
        console.log(bookId, listId);
        fetch(`/add-to-list/${bookId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                listId: listId

        })
    })
        .then(response => response.json())
        .then(data => {
                var notifDiv = document.getElementById('notification');
                if (data.error) {
                    notifDiv.innerText = data.error;
                    notifDiv.style.color = 'red';
                } else {
                    notifDiv.innerText = data.success;
                    notifDiv.style.color = 'green';
                }
                notifDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
        .catch(error => {
            console.error('A apărut o eroare:', error);
        });
    });
});
});