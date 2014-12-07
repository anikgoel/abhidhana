<?php

class TranslationsController extends AppController {

    public $components = array(
        'Translation'
    );

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $this->layout = 'dashboard';
    }

    public function translateData() {
        $this->autoRender = False;
        $data = $this->request->data;
        pr($data);
        die;
        $translated_text = $this->Translation->translateText("what you are doing?", "it", "en");
    }

}