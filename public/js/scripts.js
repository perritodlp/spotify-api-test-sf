function openModal(artistId, albumId) {
    // Cuando el usuario de clic en el link del artista, abre la modal
    document.getElementsByClassName("modal-body")[0].innerHTML = '';
    document.getElementById("myModal").style.display = "block";

    // obtengo la url del navegador
    var base_url = window.location.origin; 

    // Se le hace petición a la url que se conecta a api de Spotify para traer los datos del artista y sus albums
    fetch(base_url + '/artista/' + artistId)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('La respuesta de la red no fue correcta');
            }                
            return response.text().then(function(text) {
                document.getElementsByClassName("modal-body")[0].innerHTML = text;
            })                
        })
        .catch(function(error) {
            console.error('Ha habido un problema con su operación fetch: ', error);
        });       window.location.host; 
}

window.onload = function(event) {
    // Obtiene la modal
    var modal = document.getElementById("myModal");

    // Obtiene el elemento <span> que cierra la modal
    var span = document.getElementsByClassName("close")[0];

    // Cuando el usuario hace clic en el <span> (x), cierra la modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // Cuando el usuario hace clic por fuera de la modal, la cierra
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };      
};
