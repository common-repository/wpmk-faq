var wpmk_faq = document.getElementsByClassName("wpmk-faq-title");
var loop;

for (loop = 0; loop < wpmk_faq.length; loop++) {
    wpmk_faq[loop].addEventListener("click", function() {
        this.classList.toggle("wpmk-title-after");
        var wpmk_content = this.nextElementSibling;
        if (wpmk_content.style.maxHeight){
            wpmk_content.style.maxHeight = null;
            wpmk_content.style.paddingBottom = wpmk_content.style.paddingBottom = "0px";
            wpmk_content.style.paddingTop = wpmk_content.style.paddingTop = "0px";
            wpmk_content.style.marginBottom = wpmk_content.style.marginBottom = "0px";
            wpmk_content.style.marginBottom = wpmk_content.style.marginTop = "0px";
        }else{
            wpmk_content.style.maxHeight = wpmk_content.scrollHeight + "px";
            wpmk_content.style.paddingBottom = wpmk_content.style.paddingBottom = "10px";
            wpmk_content.style.paddingTop = wpmk_content.style.paddingTop = "10px";
            wpmk_content.style.marginBottom = wpmk_content.style.marginBottom = "10px";
            wpmk_content.style.marginBottom = wpmk_content.style.marginTop = "10px";
        } 
    });
}
/*
jQuery(document).ready(function($) {

    $('#wpmk-faq-container').find('.wpmk-faq-title').click(function(){
    
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');
        $(this).toggleClass( "wpmk-title-after" );
        
        //Hide the other panels
        $(".wpmk-faq-content").not($(this).next()).slideUp('fast');
    
    });

});
*/