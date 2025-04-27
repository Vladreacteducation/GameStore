// Dark Mode style
let styleMode = localStorage.getItem('styleMode');
const styleToggle = document.querySelector('.header-mode-switcher');

const enableDarkStyle = () => {
    document.body.classList.add('dark-mode-gamestore');
    localStorage.setItem('styleMode', 'dark');
}

const disableDarkStyle = () => {
    document.body.classList.remove('dark-mode-gamestore');
    localStorage.setItem('styleMode', null);
}


if(styleToggle){
    styleToggle.addEventListener('click', () => {
        styleMode = localStorage.getItem('styleMode');
        if(styleMode !== 'dark'){
            enableDarkStyle();
        }else{
            disableDarkStyle();
        }
    });
}


if(styleMode === 'dark'){
    enableDarkStyle();
}

//  search popup
// document.querySelector('.header-search').addEventListener('click', function() {
//  document.querySelector('.popup-games-search-container').style.display = 'block';
// });


// document.getElementById('close-search').addEventListener('click', function() {
//     document.querySelector('.popup-games-search-container').style.display = 'none';
//    });


  

   document.addEventListener('DOMContentLoaded', function () {
    const searchContainer = document.querySelector('.popup-games-search-container');
    const searchResults = document.querySelector('.popup-search-results');
    const searchInput = document.querySelector('.popup-search-input');
    const openButton = document.querySelector('.header-search');
    const closeButton = document.getElementById('close-search');
    const titleElement = document.querySelector('.search-popup-title');

    if (openButton && searchContainer && searchResults) {
        openButton.addEventListener('click', function () {
            searchContainer.style.display = 'block';
            titleElement.textContent = 'You might be interested';

            showPlaceholder();

            fetch(gamestore_params.ajaxurl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: new URLSearchParams({
                    action: 'load_latest_games',
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderGames(data.data);
                }
            })
            .catch(error => {
                console.error('Error fetching latest games', error);
            });
        });
    }

searchInput.addEventListener('input', function () {
    const searchItem = searchInput.value.trim();
    titleElement.textContent = 'Search Results';

    showPlaceholder();

    fetch(gamestore_params.ajaxurl, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: new URLSearchParams({
            action: 'search_games_by_title',
            search: searchItem
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data.length > 0) {
            titleElement.textContent = 'Search Results';
            renderGames(data.data);
        }else{
            titleElement.textContent = 'Nothing was found. You might be interested in';
            showPlaceholder();
            loadDefaultGames();
        }
    })
    .catch(error => {
        console.error('Error fetching latest games', error);
    });


});


  closeButton.addEventListener('click', function () {
       searchContainer.style.display = 'none';
       searchResults.innerHTML = "";
    });



 


    function showPlaceholder() {
        searchResults.innerHTML = ""; // правильний innerHTML
        for (let i = 0; i < 12; i++) {
            const placeholder = document.createElement('div');
            placeholder.className = 'game-placeholder';
            searchResults.appendChild(placeholder);
        }
    }

    function renderGames(games) {
        searchResults.innerHTML = "";
        games.forEach(game => {
            const gameDiv = document.createElement('div');
            gameDiv.className = 'game-result';
            gameDiv.innerHTML = 
             `<a href="${game.link}">
               <div class="game-featured-image">${game.thumbnail}</div>
               <div class="game-meta">
              <div class="game-price"> ${game.price}</div>
                <h3>${game.title}</h3>
               </div>
             </a>`; // структура HTML для пошук
            searchResults.appendChild(gameDiv);
        });
    }

function loadDefaultGames() {

    fetch(gamestore_params.ajaxurl, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: new URLSearchParams({
            action: 'load_latest_games',
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            renderGames(data.data);
        }
    })
    .catch(error => {
        console.error('Error fetching latest games', error);
    });

}

    });

