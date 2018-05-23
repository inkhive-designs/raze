/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery(document).ready( function() {
//Enable Disable Switch Control
    $('body').on('click', '.enable-disable-switch', function () {
        var $this = $(this);
        if ($this.hasClass('switch-enable')) {
            $(this).removeClass('switch-enable');
            $this.next('input').val('disable').trigger('change')
        } else {
            $(this).addClass('switch-enable');
            $this.next('input').val('enable').trigger('change')
        }
    });


    //FontAwesome Icon Control JS
    $('body').on('click', '.raze-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.raze-icon-list').prev('.raze-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.raze-icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.raze-selected-icon', function(){
        $(this).next().slideToggle();
    });

    //Skin Control JS
    $('body').on('click', '.raze-skin-list li', function(){
        var skin_class = $(this).find('i').attr('class');
        $(this).addClass('skin-active').siblings().removeClass('skin-active');
        $(this).parent('.raze-skin-list').prev('.raze-selected-skin').children('i').attr('class','').addClass(skin_class);
        $(this).parent('.raze-skin-list').next('input').val(skin_class).trigger('change');
    });

    $('body').on('click', '.raze-selected-skin', function(){
        $(this).next().slideToggle();
    });
    //
    // $('body').on('click', '.raze-skin-list li', function(){
    //     var skin_class = $(this).data('bg');
    //     $('.skin-val').val(skin_class);
    // });


});