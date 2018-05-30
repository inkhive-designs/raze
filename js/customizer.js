/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery(document).ready( function() {
//Enable Disable Switch Control
    jQuery('body').on('click', '.enable-disable-switch', function () {
        var jQuerythis = jQuery(this);
        if (jQuerythis.hasClass('switch-enable')) {
            jQuery(this).removeClass('switch-enable');
            jQuerythis.next('input').val('disable').trigger('change')
        } else {
            jQuery(this).addClass('switch-enable');
            jQuerythis.next('input').val('enable').trigger('change')
        }
    });


    //FontAwesome Icon Control JS
    jQuery('body').on('click', '.raze-icon-list li', function(){
        var icon_class = jQuery(this).find('i').attr('class');
        jQuery(this).addClass('icon-active').siblings().removeClass('icon-active');
        jQuery(this).parent('.raze-icon-list').prev('.raze-selected-icon').children('i').attr('class','').addClass(icon_class);
        jQuery(this).parent('.raze-icon-list').next('input').val(icon_class).trigger('change');
    });

    jQuery('body').on('click', '.raze-selected-icon', function(){
        jQuery(this).next().slideToggle();
    });

    //Skin Control JS
    jQuery('body').on('click', '.raze-skin-list li', function(){
        var skin_class = jQuery(this).find('i').attr('class');
        jQuery(this).addClass('skin-active').siblings().removeClass('skin-active');
        jQuery(this).parent('.raze-skin-list').prev('.raze-selected-skin').children('i').attr('class','').addClass(skin_class);
        jQuery(this).parent('.raze-skin-list').next('input').val(skin_class).trigger('change');
    });

    jQuery('body').on('click', '.raze-selected-skin', function(){
        jQuery(this).next().slideToggle();
    });
    //
    // jQuery('body').on('click', '.raze-skin-list li', function(){
    //     var skin_class = jQuery(this).data('bg');
    //     jQuery('.skin-val').val(skin_class);
    // });


});