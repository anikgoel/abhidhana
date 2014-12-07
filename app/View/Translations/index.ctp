
<!DOCTYPE html>
<html class="no-js consumer" lang="en">
  <head>

    <script>
(function(e, p){
    var m = location.href.match(/platform=(win8|win|mac|linux|cros)/);
    e.id = (m && m[1]) ||
           (p.indexOf('Windows NT 6.2') > -1 ? 'win8' : p.indexOf('Windows') > -1 ? 'win' : p.indexOf('Mac') > -1 ? 'mac' : p.indexOf('CrOS') > -1 ? 'cros' : 'linux');
    e.className = e.className.replace(/\bno-js\b/,'js');
  })(document.documentElement, window.navigator.userAgent)
    </script>
    <meta charset="utf-8">
    <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
    <meta content=
    "Google Chrome is a browser that combines a minimal design with sophisticated technology to make the web faster, safer, and easier."
    name="description">
    <title>
      Chrome Browser
    </title>
    <link href="https://plus.google.com/100585555255542998765" rel="publisher">
    <link href="//www.google.com/images/icons/product/chrome-32.png" rel="icon" type="image/ico">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel=
    "stylesheet">
    <link href="https://www.google.com/intl/en/chrome/assets/common/css/chrome.min.css" rel="stylesheet">
    <script src="//www.google.com/js/gweb/analytics/autotrack.js">
</script>
    <script>
new gweb.analytics.AutoTrack({
          profile: 'UA-26908291-1'
        });
    </script>
    <style>
#info {
    font-size: 20px;
    }
    #div_start {
    float: right;
    }
    #headline {
    text-decoration: none
    }
    #results {
    font-size: 14px;
    font-weight: bold;
    border: 1px solid #ddd;
    padding: 15px;
    text-align: left;
    min-height: 150px;
    }
    #start_button {
    border: 0;
    background-color:transparent;
    padding: 0;
    }
    .interim {
    color: gray;
    }
    .final {
    color: black;
    padding-right: 3px;
    }
    .button {
    display: none;
    }
    .marquee {
    margin: 20px auto;
    }

    #buttons {
    margin: 10px 0;
    position: relative;
    top: -50px;
    }

    #copy {
    margin-top: 20px;
    }

    #copy > div {
    display: none;
    margin: 0 70px;
    }
    </style>
    <style>
a.c1 {font-weight: normal;}
    </style>
  </head>
  <body class="" id="grid">
    <div class="browser-landing" id="main">
      <div class="compact marquee-stacked" id="marquee">
        <div class="marquee-copy">
          <h1>
            <a class="c1" href="http://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html">Web
            Speech API</a> Demonstration
          </h1>
        </div>
      </div>
      <div class="compact marquee">
        <div id="info">
          <p id="info_start">
            Click on the microphone icon and begin speaking for as long as you like.
          </p>
          <p id="info_speak_now" style="display:none">
            Speak now.
          </p>
          <p id="info_no_speech" style="display:none">
            No speech was detected. You may need to adjust your <a href=
            "//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">microphone
            settings</a>.
          </p>
          <p id="info_no_microphone" style="display:none">
            No microphone was found. Ensure that a microphone is installed and that
            <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
            microphone settings</a> are configured correctly.
          </p>
          <p id="info_allow" style="display:none">
            Click the "Allow" button above to enable your microphone.
          </p>
          <p id="info_denied" style="display:none">
            Permission to use microphone was denied.
          </p>
          <p id="info_blocked" style="display:none">
            Permission to use microphone is blocked. To change, go to
            chrome://settings/contentExceptions#media-stream
          </p>
          <p id="info_upgrade" style="display:none">
            Web Speech API is not supported by this browser. Upgrade to <a href=
            "//www.google.com/chrome">Chrome</a> version 25 or later.
          </p>
        </div>
        <div id="div_start">
          <button id="start_button" onclick="startButton(event)"><img alt="Start" id="start_img"
          src="https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif"></button>
        </div>
        <div id="results">
          <span class="final" id="final_span"></span> <span class="interim" id=
          "interim_span"></span>
        </div>
        <div id="copy">
          <button class="button" id="copy_button" onclick="copyButton()">Copy and Paste</button>
          <div id="copy_info">
            <p>
              Press Control-C to copy text.
            </p>
            <p>
              (Command-C on Mac.)
            </p>
          </div><button class="button" id="email_button" onclick="emailButton()">Create
          Email</button>
          <div id="email_info">
            <p>
              Text sent to default email application.
            </p>
            <p>
              (See chrome://settings/handlers to change.)
            </p>
          </div>
        </div>
        <div class="compact marquee" id="div_language">
          <select id="select_language" onchange="updateCountry()">
            </select>&nbsp;&nbsp; <select id="select_dialect">
            </select>
        </div>
      </div>
    </div><script src="https://www.google.com/intl/en/chrome/assets/common/js/chrome.min.js">
</script> <script>
    </script>
    <?php
    echo $this->Html->script(array(
        'SpeechToText'
    ));
    ?>
  </body>
</html>
