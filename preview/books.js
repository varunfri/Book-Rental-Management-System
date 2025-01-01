const API_KEY = 'AIzaSyBnsBxf9DyK3Us_jQPU4xjJToWDDwbIxDI'; // Replace with your actual API key

    function loadGoogleBooksApi() {
        google.books.load();
    }

    function previewBook(book_name, isbn) {
        var modal = document.getElementById('modal');
        var modalContent = document.getElementById('modal-content');
        var load_spin =  document.getElementById('loading-spinner');
        
        modal.style.display = "block";
        
        
        if (isbn) {
            const url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}&key=${API_KEY}`;
           
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.items && data.items.length > 0) {
                        modalContent.innerHTML = `
            <h1 class="h1">${book_name}</h1>
            <br>
             <div class="h1">Loading..</div>
            <div>   
                <center> 
                  <div id="viewerCanvas" style="width: 600px; height: 600px; border: 1px solid #ccc; margin-top: 20px;"></div>
                </center>
            </div> 
        `;
                        embedBook(isbn);
                    } else {
                        modalContent.innerHTML += `<p>No book found with this ISBN.</p>`;
                       load_spin.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalContent.innerHTML += `<p>Error fetching book details.</p>`;
                     load_spin.style.display = 'none';
                });
        } else {
            modalContent.innerHTML += `<p>Please enter an ISBN.</p>`;
            load_spin.style.display = 'none';
        }
    }

    // function embedBook(isbn) {
    //     const viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
    //     viewer.load('ISBN:' + isbn, displayError);
    // }
    function embedBook(isbn) {
        const viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
        viewer.load('ISBN:' + isbn, function(success) {
            if (!success) {
                console.error('Error loading Google Book Viewer.');
            }
            load_spin.style.display = 'none';
        });
    }

    function displayError() {
        console.error('Error loading Google Book Viewer.');
    }

    function closeModal() {
        var modal = document.getElementById('modal');
        if (modal) {
            modal.style.display = "none";
        } else {
            console.error('Modal not found.');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });

    window.addEventListener('click', function(event) {
        var modal = document.getElementById('modal');
        if (event.target == modal) {
            closeModal();
        }
    });

    google.books.setOnLoadCallback(loadGoogleBooksApi);