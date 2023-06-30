function makeBattleCarousels() {
    for(let i = 0; i < carousels.length; i++){
        let item = carousels[i];
        item.carousel.owlCarousel({
            margin:10,
            autoWidth:true,
            onInitialized:initialized,
            onTranslated:translated,

        });
        item.nextButton.click(function () {
            item.carousel.trigger('next.owl.carousel');
        });
        item.prevButton.click(function () {
            item.carousel.trigger('prev.owl.carousel');
        });
    }
}
function initialized(event){
    for(let i = 0; i < carousels.length; i++){
        let item = carousels[i];
        if(event.target.id === item.target){
            if(item.carousel.find('.owl-stage-outer').width() < item.carousel.find('.owl-stage').width()){
                item.nextButton.children('i').css('color','white');
            }
            break;
        }
    }
}
function translated(event) {
    for(let i = 0 ; i < carousels.length; i++){
        let item = carousels[i];
        if(event.target.id === item.target){
            if($(item.carousel.find('.owl-stage')).position().left + $(item.carousel.find('.owl-stage')).width() <= $(item.carousel.find('.owl-stage-outer')).width()){
                item.nextButton.children('i').css('color', '#303033')
            }else{
                item.nextButton.children('i').css('color', 'white')
            }
            if(event.item.index === 0){
                item.prevButton.children('i').css('color', '#303033')
            }else{
                item.prevButton.children('i').css('color', 'white')
            }
            break;
        }
    }
}
let owlCarousels = $('.owl-carousel:not(#owl_main)');
let carousels = [];
for(let i = 0; i < owlCarousels.length; i++){
    let id = $(owlCarousels[i]).attr('id').slice(7,-9);

    carousels[i] = {
        carousel:$('#battle_'+ id +'_carousel'),
        target:'battle_'+ id +'_carousel',
        nextButton:$('#'+ id +'_next'),
        prevButton:$('#'+ id +'_prev'),
    }
}
$(window).resize(function () {
    for(let i = 0 ; i < carousels.length; i++){
        let item = carousels[i];
        if($(item.carousel.find('.owl-stage')).position().left + $(item.carousel.find('.owl-stage')).width() <= $(item.carousel.find('.owl-stage-outer')).width()){
            item.nextButton.children('i').css('color', '#303033')
        }else{
            item.nextButton.children('i').css('color', 'white')
        }
    }
})
