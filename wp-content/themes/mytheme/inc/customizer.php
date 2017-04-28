<?php
/**
 * Name       : Base_Customizer
 * Version    : 1.0.0
 */
class Base_Customizer {
    /**
     * Default theme options
     * @var array
     */
    protected static $defaults = array();

    /**
     * @var Habakiri_Customizer_Framework
     */
    protected $Customizer_Framework;

    public function __construct() {
        $this->Customizer_Framework = new Habakiri_Customizer_Framework();
    }

    /**
     * Return default value
     *
     * @param string $key
     * @return null|string
     */
    public static function get_default( $key ) {
        self::$defaults = apply_filters(
            'theme_mods_defaults',
            array(
                'logo'                             => '',
                'footer_bg_color'                  => '#111113',
                'excerpt_length'                   => ( get_locale() == 'ja' ) ? 110 : 220,
            )
        );
        if ( isset( self::$defaults[$key] ) ) {
            return self::$defaults[$key];
        }
    }

    /**
     * Set the original item on the theme customizer
     *
     * @param WP_Customize_Manager $wp_customize
     */
    public function customize_register( $wp_customize ) {
        $this->Customizer_Framework->register_customizer( $wp_customize );

        $this->Customizer_Framework->add_panel( 'base_colors', array(
            'title'    => __( 'Colors', 'habakiri' ),
            'priority' => 110,
        ) );
        // colors - footer
        $this->Customizer_Framework->add_section( 'colors_footer', array(
            'title' =>  __( 'Footer', 'habakiri' ),
            'panel' => 'base_colors',
        ) );

        $this->Customizer_Framework->color( 'footer_bg_color', array(
            'label'   => __( 'Background color', 'habakiri' ),
            'default' => self::get_default( 'footer_bg_color' ),
            'section' => 'colors_footer',
        ) );

        // 画像追加
        $this->Customizer_Framework->add_section( 'logo_settings', array(
            'title'    => __( 'ロゴ設定' ),
            'priority' => 111,
        ) );

        $this->Customizer_Framework->image( 'logo', array(
            'label'   => __( 'Logo', 'habakiri' ),
            'section' => 'logo_settings',
        ) );

        $this->Customizer_Framework->add_section( 'settings', array(
            'title' =>  __( 'Settings', 'habakiri' ),
            'priority' => 112,
        ) );

        $this->Customizer_Framework->number( 'excerpt_length', array(
            'label'   => __( 'Excerpt length', 'habakiri' ),
            'default' => self::get_default( 'excerpt_length' ),
            'section' => 'settings',
            'input_attrs' => array(
                'size'  => 3,
                'style' => 'width: 60px;'
            ),
        ) );

    }

    /**
     * Convert the color code to the RGB
     *
     * @param string $hex
     */
    protected function hex_to_rgb( $hex ) {
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        } else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }
        return array( $r, $g, $b );
    }


    /**
     * set original styles
     */
    public function register_styles() {
        $this->Customizer_Framework->register_styles(
            array(
                'footer', // element
                //'.footer' // class
                //'#footer' // id
            ),
            array(
                sprintf( 'background-color: %s', Core::get( 'footer_bg_color' ) ),
            )
        );

    }
}
