$(".five li ul").hide();
$(".five li:has('.submenu')").hover(
    function(){
        $(".five li ul").stop().fadeToggle(300);}
);
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()
