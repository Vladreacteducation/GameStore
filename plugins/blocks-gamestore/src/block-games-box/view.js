document.addEventListener('DOMContentLoaded',function(){

  const filterForm = document.querySelector('.games-filter form');
  const sortingForm = document.querySelector('.custom-sort form');
  const loadMoreButton = document.querySelector('.load-more-button');
  let currentPage = 1;

  filterForm.addEventListener('change', function(){
    currentPage = 1;
    submitForm(false);
  });

  sortingForm.addEventListener('change', function(){
    currentPage = 1;
    submitForm(false);
  });

  filterForm.addEventListener('reset', function(){
    currentPage = 1;
    setTimeout(()=> {
      submitForm(false);
    },100);
  });

  loadMoreButton.addEventListener('click', function(){
    currentPage++;
    submitForm(true);
  })

  function submitForm(append = false){
    const formData = new FormData(filterForm);
    const formSortingData = new FormData(sortingForm);

    const selectedLanguages = [];
    document.querySelectorAll('input[name^="language-"]:checked').forEach((checkbox)=> {
      selectedLanguages.push(checkbox.name.replace('language-',''));
    })

    const selectedGenres = [];
    document.querySelectorAll('input[name^="genre-"]:checked').forEach((checkbox)=> {
      selectedGenres.push(checkbox.name.replace('genre-',''));
    })

    fetch(gamestore_params.ajaxurl, {
      method: 'POST',
      body: new URLSearchParams({
        action: 'filter_games',
        page: currentPage,
        post_per_page: formData.get('posts_per_page'),
        platforms: formData.get('platforms'),
        publisher: formData.get('publisher'),
        singleplayer: formData.get('singleplayer'),
        released: formData.get('released'),
        languages: selectedLanguages.join(','),
        genres: selectedGenres.join(','),
        sort: formSortingData.get('sorting'),
      })
    })
    .then(response => response.text())
    .then(data => {
      const gamesListContainer = document.querySelector('.games-list');
      if(append){
        gamesListContainer.innerHTML += data;
      } else {
        gamesListContainer.innerHTML = data;
      }
    })
    .catch(error => console.error('Error', error));

  }

});