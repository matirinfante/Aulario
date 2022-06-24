/* Funciones para subir al principio de la página */
function scrollUp(){
    var $currentScroll = document.documentElement.scrollTop; // Obtiene el número de pixels desplazados
    if($currentScroll > 0){
        $('html, body').animate({scrollTop: '0px'}, 500);
    }
}

var $buttonTop = document.getElementById('pageUp');
window.onscroll = function(){
    var $scroll = document.documentElement.scrollTop;
    if($scroll > 300){
        $buttonTop.style.transform = 'scale(1)';
       }else{
           $buttonTop.style.transform = 'scale(0)';
       }
   }