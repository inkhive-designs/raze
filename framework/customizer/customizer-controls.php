<?php
/*
** Customizer Controls
*/
if (class_exists('WP_Customize_Control')) {
    class Raze_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'raze' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}

if ( class_exists('WP_Customize_Control') && class_exists('woocommerce') ) {
    class Raze_WP_Customize_Product_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'raze' ),
                    'option_none_value' => '0',
                    'taxonomy'          => 'product_cat',
                    'selected'          => $this->value(),
                )
            );

            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}
if (class_exists('WP_Customize_Control')) {
    class Raze_WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}


if( class_exists( 'WP_Customize_Control' ) ):
class Raze_Switch_Control extends WP_Customize_Control{
    public $type = 'switch';
    public $enable_disable = array();

    public function __construct($manager, $id, $args = array() ){
        $this->enable_disable = $args['enable_disable'];
        parent::__construct( $manager, $id, $args );
    }

    public function render_content(){
        ?>
        <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

        <?php if($this->description){ ?>
            <span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
        <?php } ?>

        <?php
        $switch_class = ($this->value() == 'enable') ? 'switch-enable' : '';
        $enable_disable = $this->enable_disable;
        ?>
        <div class="enable-disable-switch <?php echo $switch_class; ?>">
            <div class="enable-disable-switch-inner">
                <div class="enable-disable-switch-enabled">
                    <div class="enable-disable-switch-switch"><?php echo esc_html($enable_disable['enable']) ?></div>
                </div>

                <div class="enable-disable-switch-disabled">
                    <div class="enable-disable-switch-switch"><?php echo esc_html($enable_disable['disable']) ?></div>
                </div>
            </div>
        </div>
        <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
        <?php
    }
}

        class Raze_Custom_JS_Control extends WP_Customize_Control {
            public $type = 'textarea';

            public function render_content() {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <textarea rows="8" style="width:100%;background: #222; color: #eee;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
                </label>
                <?php
            }
        }

    class Raze_misc_scripts extends WP_Customize_Control{

        public function render_content(){
            ?>
            <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
            <?php }
        }
    }


    class Raze_Fontawesome_Icon_Chooser extends WP_Customize_Control{
        public $type = 'icon';

        public function render_content(){
            ?>
            <label>
                <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
                    <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
                <?php } ?>

                <div class="raze-selected-icon">
                    <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                    <span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul class="raze-icon-list clearfix">
                    <?php
                    $raze_fa_icon_array = raze_fa_icon_array();
                    foreach ($raze_fa_icon_array as $raze_fa_icon => $value) {
                        $icon_class = $this->value() == $raze_fa_icon ? 'icon-active' : '';
                        echo '<li class='.$icon_class.'><i class="'.$raze_fa_icon.'"></i></li>';
                    }
                    ?>
                </ul>
                <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
            </label>
            <?php
        }
    }


    class Raze_Skin_Chooser extends WP_Customize_Control{
        public $type = 'skins';

        public function render_content(){
            ?>
            
            <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
            	<?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <?php $name = '_customize-skin-' . $this->id;
	            foreach ($this->choices as $key=>$value) { ?>
                    <label>
                        <input type="radio" class="custom_skin_control" style="background: <?php echo $key; ?>"  value="<?php echo esc_attr($value); ?>" <?php $this->link(); ?> name="<?php echo esc_attr( $name ); ?>" <?php checked( $this->value(), $value ); ?>/>
                    </label>
           <?php }
        }
    }



    //two settings control wittemp
    class WP_Customize_Schedule_Fields_Control extends WP_Customize_Control
    {
        /**
         * Choices/options for the select dropdown.
         *
         * @var array
         */
        public $select_choices = array();

        /**
         * HTML Attributes to add to the <select> tag
         *
         * @var array
         */
        public $select_attrs = array();

        public $type = 'email_notification_schedule';

        public function select_attrs()
        {
            foreach ($this->select_attrs as $attr => $value) {
                echo $attr . '="' . esc_attr($value) . '" ';
            }
        }

        public function render_content()
        {
            ?>
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>
                <input type="<?php echo esc_attr($this->type); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value('schedule_digit')); ?>" <?php $this->link('schedule_digit'); ?> />
                <select <?php $this->link('schedule_type'); ?> <?php $this->select_attrs(); ?> >
                    <?php
                    foreach ($this->select_choices as $value => $label)
                        echo '<option value="' . esc_attr($value) . '"' . selected($this->value('schedule_type'), $value, false) . '>' . $label . '</option>';
                    ?>
                </select>
            </label>

            <?php if (!empty($this->description)) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif;
        }
    }
endif;
