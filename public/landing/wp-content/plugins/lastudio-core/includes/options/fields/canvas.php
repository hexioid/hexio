<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Canvas
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class LaStudio_Framework_Field_canvas extends LaStudio_Framework_Field_Base {

    public function __construct( $field, $value = '', $unique = '' ) {
        parent::__construct( $field, $value, $unique );
    }

    private function render_child_fields( $child_id ){
        return la_fw_add_element( array(
            'pseudo'          => true,
            'id'              => "{$this->field['id']}_{$child_id}",
            'type'            => 'text',
            'name'            => $this->element_name( "[{$child_id}]" ),
            'value'           => $this->value['margin_top'],
            'default'         => ( isset( $this->field['default'][$child_id] ) ) ? $this->field['default'][$child_id] : '',
            'class'           => 'la-child-field',
            'wrap_class'      => 'canvas__' . $child_id,
            'attributes'      => array(
                'data-atts'     => $child_id,
                'placeholder'   => '-'
            )
        ) );
    }

    public function output() {
	    echo $this->element_before();

        $option_defaults = array(
            'margin'        => true,
            'radius'        => true,
            'border'        => true,
            'padding'       => true
        );

        $value_defaults = array(
            'margin_top'        => '',
            'margin_right'      => '',
            'margin_bottom'     => '',
            'margin_left'       => '',
            'border_top'        => '',
            'border_right'      => '',
            'border_bottom'     => '',
            'border_left'       => '',
            'border_type'       => '',
            'border_color'      => '',
            'padding_top'       => '',
            'padding_right'     => '',
            'padding_bottom'    => '',
            'padding_left'      => '',
            'radius_top'        => '',
            'radius_right'      => '',
            'radius_bottom'     => '',
            'radius_left'       => ''
        );

        $this->options = wp_parse_args( isset($this->field['options']) ? $this->field['options'] : array() , $option_defaults );
        $this->value    = wp_parse_args( $this->element_value(), $value_defaults );


        if($this->options['margin'] || $this->options['radius'] || $this->options['border'] || $this->options['padding']){
            $la_attr = '';
            if(!empty( $this->field['attributes']['data-customize-setting-link'] )){
                $la_attr .= ' data-la-customize-setting-link="' . $this->field['attributes']['data-customize-setting-link'] . '"';
                $la_attr .= ' data-la-customize-setting-key="'. (( isset( $this->field['id'] ) ) ? $this->field['id'] : '') .'"';
                unset($this->field['attributes']['data-customize-setting-link']);
            }
            ?>
            <div <?php echo $this->element_class('la-parent-fields') . $la_attr;?>>
                <fieldset>
                    <div class="la_group__canvas">
                        <div class="la_group__canvas--left">
                            <?php if($this->options['margin']):?>
                                <div class="la_group__canvas__margin">
                                    <label><?php echo esc_html_x('Margin', 'admin-view', 'la-studio'); ?></label>
                                    <?php
                                    echo $this->render_child_fields('margin_top');
                                    echo $this->render_child_fields('margin_right');
                                    echo $this->render_child_fields('margin_bottom');
                                    echo $this->render_child_fields('margin_left');
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($this->options['border']):?>
                                <div class="la_group__canvas__border">
                                    <label><?php echo esc_html_x('Border', 'admin-view', 'la-studio'); ?></label>
                                    <?php
                                    echo $this->render_child_fields('border_top');
                                    echo $this->render_child_fields('border_right');
                                    echo $this->render_child_fields('border_bottom');
                                    echo $this->render_child_fields('border_left');
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($this->options['radius']):?>
                                <div class="la_group__canvas__radius">
                                    <label><?php echo esc_html_x('Border Radius', 'admin-view', 'la-studio'); ?></label>
                                    <?php
                                    echo $this->render_child_fields('radius_top');
                                    echo $this->render_child_fields('radius_right');
                                    echo $this->render_child_fields('radius_bottom');
                                    echo $this->render_child_fields('radius_left');
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($this->options['padding']):?>
                                <div class="la_group__canvas__padding">
                                    <label><?php echo esc_html_x('Padding', 'admin-view', 'la-studio'); ?></label>
                                    <?php
                                    echo $this->render_child_fields('padding_top');
                                    echo $this->render_child_fields('padding_right');
                                    echo $this->render_child_fields('padding_bottom');
                                    echo $this->render_child_fields('padding_left');
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="la_group__canvas__content">
                                <i></i>
                            </div>
                        </div>
                        <div class="la_group__canvas--right">
                            <?php if($this->options['border']):?>
                                <?php
                                echo la_fw_add_element( array(
                                    'pseudo'          => true,
                                    'id'              => $this->field['id'].'_border_type',
                                    'title'           => esc_html_x('Border Style', 'admin-view', 'la-studio'),
                                    'type'            => 'select',
                                    'name'            => $this->element_name( '[border_type]' ),
                                    'options'         => array(
                                        ''          =>  esc_html_x('Theme defaults', 'admin-view', 'la-studio'),
                                        'solid'     =>  esc_html_x('Solid', 'admin-view', 'la-studio'),
                                        'dotted'    =>  esc_html_x('Dotted', 'admin-view', 'la-studio'),
                                        'dashed'    =>  esc_html_x('Dashed', 'admin-view', 'la-studio'),
                                        'none'      =>  esc_html_x('None', 'admin-view', 'la-studio'),
                                        'hidden'    =>  esc_html_x('Hidden', 'admin-view', 'la-studio'),
                                        'double'    =>  esc_html_x('Double', 'admin-view', 'la-studio'),
                                        'groove'    =>  esc_html_x('Groove', 'admin-view', 'la-studio'),
                                        'ridge'     =>  esc_html_x('Ridge', 'admin-view', 'la-studio'),
                                        'inset'     =>  esc_html_x('Inset', 'admin-view', 'la-studio'),
                                        'outset'    =>  esc_html_x('Outset', 'admin-view', 'la-studio'),
                                        'initial'   =>  esc_html_x('Initial', 'admin-view', 'la-studio'),
                                        'inherit'   =>  esc_html_x('Inherit', 'admin-view', 'la-studio'),
                                    ),
                                    'value'           => $this->value['border_type'],
                                    'default'         => ( isset( $this->field['default']['border_type'] ) ) ? $this->field['default']['border_type'] : '',
                                    'class'         => 'la-child-field',
                                    'attributes'      => array(
                                        'data-atts'     => 'border_type'
                                    )
                                ) );
                                echo la_fw_add_element( array(
                                    'pseudo'          => true,
                                    'id'              => $this->field['id'].'_border_type',
                                    'title'           => esc_html_x('Border Color', 'admin-view', 'la-studio'),
                                    'type'            => 'color_picker',
                                    'name'            => $this->element_name( '[border_type]' ),
                                    'value'           => $this->value['border_type'],
                                    'default'         => ( isset( $this->field['default']['border_type'] ) ) ? $this->field['default']['border_type'] : '',
                                    'class'           => 'la-child-field',
                                    'rgba'            => true,
                                    'attributes'      => array(
                                        'data-atts'     => 'border_type'
                                    )
                                ) );
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </fieldset>
            </div>
            <?php
        }

	    echo $this->element_after();

    }

}