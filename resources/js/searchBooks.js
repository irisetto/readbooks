
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const searchButton = document.getElementById('searchButton');

searchButton.addEventListener('click', function () {
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
        fetch(request).then(res => res.json())
            .then(res => {
                res.books.forEach(book => {
                    // const li = document.createElement('li');
                    // li.textContent = `${book.title}`;
                    // ul.appendChild(li);
                    console.log(book);
                });
                searchResults.innerHTML = '';
                if (res.books.length === 0) {
                    searchResults.innerHTML = '<p>Nu s-au găsit rezultate.</p>';
                    return;
                }
                searchResults.classList.add('flex', 'flex-wrap', 'overflow-auto', 'w-100', 'justify-center');
                const books = res.books;
                let resultsHtml = '';
                res.books.forEach(book => {
                resultsHtml  += `        
                            <div class="m-2 mb-8 px-2  sm:w-1/5 md:w-1/6 ">
                            <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
                                <img src='${book['cover']}' alt="book cover" class="rounded-t-lg " />
                                <div class="p-2 flex-grow">
                                <h2 class="mb-2 text-md font-semibold">${book['title']}</h2>
                                <p class="mb-2 text-sm text-gray-700">Author: ${book['author']}</p>
                                </div>
                                ${token ? `                                <div class="p-2 mt-auto">
                                <form action="{{ route('books.addToList', ['book' => ${book['google_id']}]) }}" method="POST" class="flex justify-center">
                            
                                    <button type="submit"
                                    class="block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mt-auto"
                                    >Add to List</button>
                                </form>
                                </div>  
                                ` : ''}                            </div>
                            </div>
                                `;
                });
                searchResults.innerHTML = resultsHtml;

            //     res.books.forEach(book => {
            //         const bookCard = document.createElement('div');
            //         bookCard.classList.add('m-2', 'mb-8', 'px-2', 'sm:w-1/5', 'md:w-1/6');
            //         searchResults.appendChild(bookCard);

            //         const bookDiv = document.createElement('div');
            //         bookDiv.classList.add('rounded-lg', 'bg-white', 'shadow-lg', 'flex', 'flex-col', 'h-full');
            //         bookCard.appendChild(bookDiv);

            //         const bookImage = document.createElement('img');
            //         bookImage.src = book.cover;
            //         bookImage.classList.add('rounded-t-lg');
            //         bookDiv.appendChild(bookImage);

            //         const bookInfo = document.createElement('div');
            //         bookInfo.classList.add('p-2', 'flex-grow');
            //         bookDiv.appendChild(bookInfo);

            //         const bookTitle = document.createElement('h2');
            //         bookTitle.textContent = book.title;
            //         bookTitle.classList.add('mb-2', 'text-md', 'font-semibold');
            //         bookInfo.appendChild(bookTitle);

            //         const bookAuthor = document.createElement('p');
            //         bookAuthor.textContent = "Author: " + book.author;
            //         bookAuthor.classList.add('mb-2', 'text-sm', 'text-gray-700');
            //         bookInfo.appendChild(bookAuthor);


            //         // const bookDate = document.createElement('p');
            //         // bookDate.textContent = book.author;
            //         // bookDate.classList.add('mb-4','text-sm','text-gray-700');
            //         // bookInfo.appendChild(bookDate);
            //         @auth
            //         // Creează elementul pentru formularul de adăugare în listă
            //         const formElement = document.createElement('form');
            //         formElement.action = '{{ route('books.addToList', ['book' => '']) }}' + book.id;
            //         formElement.method = 'POST';
            //         bookDiv.appendChild(formElement);

            //         // Creează elementul pentru butonul de adăugare în listă
            //         const buttonElement = document.createElement('button');
            //         buttonElement.type = 'submit';
            //         buttonElement.classList.add('block', 'rounded-lg', 'bg-blue-500', 'px-4', 'py-2', 'text-center', 'font-semibold', 'text-white', 'hover:bg-blue-600', 'mt-auto');
            //         buttonElement.textContent = 'Add to List';
            //         formElement.appendChild(buttonElement);
            //         @endauth
            //     });

            // }
            // )
            //  .then(data => {
            //      console.log(data);
            //     //     searchResults.innerHTML = '';
            //     if (data.length === 0) {
            //         searchResults.innerHTML = '<p>Nu s-au găsit rezultate.</p>';
            //         return;
            //     }
            //     const ul = document.createElement('ul');

            // data.books.forEach(book => {
            //     // const li = document.createElement('li');
            //     // li.textContent = `${book.title}`;
            //     // ul.appendChild(li);
            //     console.log(book);
            // });

            // searchResults.appendChild(ul);
             })
            .catch(error => {
                console.error('Error:', error);
            });


        // .then(response => response.json())
        // .then(data => {
        //     searchResults.innerHTML = '';
        //     if (data.length === 0) {
        //         searchResults.innerHTML = '<p>Nu s-au găsit rezultate.</p>';
        //         return;
        //     }
        //     const ul = document.createElement('ul');

        //     data.forEach(book => {
        //         const li = document.createElement('li');
        //         li.textContent = `${book.title}`;
        //         ul.appendChild(li);
        //     });

        //     searchResults.appendChild(ul);
        // })
        // .catch(error => {
        //     console.error('A apărut o eroare în timpul căutării:', error);
        // });
    } else {
        searchResults.innerHTML = '';
    }
});
