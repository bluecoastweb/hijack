<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hijack_ext {
    public $name           = 'Hijack';
    public $version        = '1.1';
    public $description    = 'Inject Javascript into the Control Panel.';
    public $settings_exist = 'y';
    public $docs_url       = 'http://www.bluecoastweb.com/';
    public $settings       = array();
    private $EE;

    public function __construct($settings='') {
        $this->EE =& get_instance();
        $this->settings = $settings;
    }

    function settings() {
        $settings = array();
        $settings['content'] = array('t', array('rows' => '20'), '');
        $settings['wrap']    = array('r', array('y' => "Yes", 'n' => "No"), 'y');
        return $settings;
    }

    public function activate_extension() {
        $data = array(
            'class'     => __CLASS__,
            'method'    => 'cp_js_end',
            'hook'      => 'cp_js_end',
            'settings'  => serialize($this->settings),
            'priority'  => 100,
            'version'   => $this->version,
            'enabled'   => 'y'
        );

        $this->EE->db->insert('extensions', $data);
    }

    public function cp_js_end() {
        $content = $this->settings['content'];
        $wrap    = $this->settings['wrap'];
        if ($wrap === 'y') {
            $content = '$(function() { ' . $content . ' });';
        }
        return $this->EE->extensions->last_call . $content;
    }

    function update_extension($current='') {
        if ($current == '' OR $current == $this->version) {
            return FALSE;
        }

        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->update('extensions', array('version' => $this->version));
    }

    function disable_extension(){
        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->delete('extensions');
    }
}
