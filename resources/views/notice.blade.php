<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stickers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Notice Board</h1>
                <div id="stickers">
                    <!-- Stickers will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to fetch stickers data
            function fetchStickers() {
                fetch("http://localhost:8000/api/stickers")
                    .then(response => response.json())
                    .then(data => {
                        if(data && data.length > 0){
                            var stickersContainer = document.getElementById('stickers');
                            stickersContainer.innerHTML = ''; // Clear previous stickers
                            data.forEach(sticker => {
                                stickersContainer.innerHTML += `
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${sticker.name}</h5>
                                                <p class="card-text">${sticker.description}</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        }
                        else{
                            document.getElementById('stickers').innerHTML = '<p>No stickers found.</p>';
                        }
                        // Cache stickers data in localStorage
                        localStorage.setItem('stickersData', JSON.stringify(data));
                    })
                    .catch(error => console.error('Error fetching stickers:', error));
            }

            // Fetch stickers initially
            fetchStickers();

            // Fetch stickers every 30 seconds
            setInterval(fetchStickers, 3000);
        });
    </script>
</body>
</html>
