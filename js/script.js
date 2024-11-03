window.onload = function() {

    let audio = document.querySelector("audio");

    let timeDisplay = document.querySelector(".txt_audio");
  
    // Mise à jour de l'affichage de la durée toutes les secondes
    setInterval(function() {
      let currentTime = audio.currentTime;
      let minutes = Math.floor(currentTime / 60);
      let seconds = Math.floor(currentTime % 60);

      // Ajout d'un 0 devant les secondes si nécessaire
      if (seconds < 10) {
        seconds = "0" + seconds;
      }
      timeDisplay.textContent = "Durée : " + minutes + ":" + seconds + " / 1:34";
      
      if (!audio.paused) {
        timeDisplay.style.color = "#00eaff";
      } 
      else {
        timeDisplay.style.color = "red";
      }
    }, 1000);
  
    let playButton = document.querySelector(".btn-music-play");
    playButton.addEventListener("click", function() {
      audio.play();
    });
  
    let pauseButton = document.querySelector(".btn-music-pause");
    pauseButton.addEventListener("click", function() {
      audio.pause();
    });
  
    let stopButton = document.querySelector(".btn-music-stop");
    stopButton.addEventListener("click", function() {
      audio.pause();
      audio.currentTime = 0;
    });



// Pagination affichage progressif avec bouton
const container = document.querySelector("div.grey_zone");
const container_btn = document.querySelector("div.btn_div");

const items = container.children;
const limit = 7;

if(items.length <= limit){
    container_btn.style.display = "none";
}else {
    const loadButton = document.getElementById("load-button");
    // cacher tous les enfants de la div sauf les 5 premiers
    for (let i = limit; i < items.length; i++) {
        items[i].style.display = "none";
    }

    let counter = limit;

    // Montrer + de résultats
    function loadItems() {
        for (let i = counter; i < counter + limit; i++) {
            // vérification de s'il reste des éléments à afficher
            if (i >= items.length) {
                loadButton.disabled = true;
                container_btn.style.display = "none";
                container.style.height = "100%";
                return;
            }
            items[i].style.display = "block";
        }
        counter += limit;
    }

    // add event listener to load button
    loadButton.addEventListener("click", loadItems);
}

}