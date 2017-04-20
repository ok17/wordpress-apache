<?php


require_once get_template_directory() . '/inc/Common.php';
require_once get_template_directory() . '/inc/class.habakiri-customizer-framework.php';
require_once get_template_directory() . '/inc/customizer.php';



function parent_theme_setup() {

    class Core extends Base_Functions
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function _mw_validation_rule($Validation)
        {
            $Validation->set_rule('career', 'noEmpty', array(
                'message' => 'ファイルが選択されていません'
            ));
            $Validation->set_rule('resume', 'noEmpty', array(
                'message' => 'ファイルが選択されていません'
            ));
            return $Validation;
        }

        /**
         *
         */
        public function _mw_validate() {
            add_filter('mwform_validation_mw-wp-form-xxx', array($this, '_mw_validation_rule'));
            add_filter('mwform_upload_dir_mw-wp-form-xxx', arraY($this, '_mw_upload_dir'), 10, 3);
            add_filter('mwform_value_mw-wp-form-xxx', array($this, '_mw_validate'), 10, 2);
        }
        /**
         * @param $path
         * @param $Data
         * @param $key
         * @return string
         */
        public function _mw_upload_dir($path, $Data, $key)
        {

            return '/mw-wp-form';
        }
    }

    $Core = new Core();
    $Core->_mw_validate();
}

add_action( 'after_setup_theme', 'parent_theme_setup', 99999 );

class Base_Functions {
    protected $Customizer_Framework;

    public function __construct()
    {
        /* カスタムメニュー */
//        add_theme_support('menus');

        // action
        add_action('wp_enqueue_scripts', array($this,'wp_enqueue_scripts'));

        $this->customizer();
    }

    public function wp_enqueue_scripts()
    {
        global $post;

        wp_enqueue_style(
            'css',
            get_template_directory_uri() . '/css/font-awesome.css',
            array(),
            null
        );
    }

    protected function customizer()
    {
        $Customizer = new Base_Customizer();
        add_action( 'wp_head', array( $Customizer, 'register_styles' ) );
        add_action( 'customize_register', array( $Customizer, 'customize_register' ) );
    }
    public static function get( $key )
    {
        $default   = Base_Customizer::get_default( $key );
        $theme_mod = get_theme_mod( $key, $default );
        return $theme_mod;
    }
}
