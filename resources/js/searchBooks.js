
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
        fetch(request).then(res => res.text())
            .then(res => {
                searchResults.innerHTML = res;

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
