<?php

App::uses('Component', 'Controller');

use Buzz\Browser;
use MatthiasNoback\MicrosoftOAuth\AccessTokenProvider;
use MatthiasNoback\MicrosoftTranslator\MicrosoftTranslator;

class TranslationComponent extends Component {

    private $Controller;
    private $client;
    private $service;

    public function initialize(Controller $controller) {
        /* The initialize method is called before the controller’s beforeFilter method. */
    }

    public function startup(Controller $controller) {
        $this->Controller = & $controller;
//	App::import('Vendor', 'Google_Service_YouTube_VideoSnippet', array('file' => 'YouTubeApi/src/Google/Service/YouTube.php'));
//	App::import('Vendor', 'Google_Service_YouTube_Video', array('file' => 'YouTubeApi/src/Google/Service/YouTube.php'));
        /* The startup method is called after the controller’s beforeFilter method but before 
         * the controller executes the current action handler. */
    }

    public function shutdown(Controller $controller) {
        /* The shutdown method is called before output is sent to browser. */
    }

    public function beforeRender(Controller $controller) {
        /* The beforeRender method is called after the controller executes the requested action’s 
         * logic but before the controller’s renders views and layout. */
    }

    public function beforeRedirect(Controller $controller, $url, $status = NULL, $exit = true) {
        /* The beforeRedirect method is invoked when the controller’s redirect method is called but 
         * before any further action. If this method returns false the controller will not continue 
         * on to redirect the request. The $url, $status and $exit variables have same meaning as for 
         * the controller’s method. You can also return a string which will be interpreted as the url 
         * to redirect to or return associative array with key ‘url’ and optionally ‘status’ and ‘exit’. */
    }

    public function translateText($text, $to, $from) {
        $browser = new Browser();

        $clientId = 'abhidhana';
        $clientSecret = '9cFCitsEpEeFJh6dDRpfRqw6IYst4XW0fTw/7BjuX/c=';
        $accessTokenProvider = new AccessTokenProvider($browser, $clientId, $clientSecret);
        $translator = new MicrosoftTranslator($browser, $accessTokenProvider);
        $translatedString = $translator->translate($text, $to, $from);
        return $translatedString;
    }

}