function add() {

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
    }
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const searchButton = document.getElementById('searchButton');

function performSearch(){
    const query = searchInput.value.trim();
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const urlReq = "/books/search";
    if (query !== '') {

        const request = new Request(urlReq, {
            method: 'POST',
            credentials: "same-origin",

            body: JSON.stringify({ query: `${query}` }),
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
        });
        fetch(request)
        .then(res => res.text())
            .then(res => {
                searchResults.innerHTML = res;
                add();
             })
            .catch(error => {
                console.error('Error:', error);
            });

    } else {
        searchResults.innerHTML = '';
    }

}
searchButton.addEventListener('click', performSearch);

searchInput.addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        performSearch();
    }
});
