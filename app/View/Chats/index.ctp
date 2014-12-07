<?php
echo $this->Html->script(array(
    'Chats/index.js?v=1.0',
    'Translations/languages.js?v=1.0',
    'Translations/SpeechToText.js?v=1.0',
    'Translations/TextToSpeech.js?v=1.0',
        ), array('inline' => FALSE))
?>

<div class="col-lg-2 col-md-2">
    <h3>
        Online Users
    </h3>
    <div class="list-group online_users">
        <a href="#" class="list-group-item" data-sid="anikgoel" data-name="Anik Goel">
            <i class="fa fa-circle"></i>
            <span class="badge">en-us</span>
            Anik Goel
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-circle"></i>
            <span class="badge">en-in</span>
            Atul Tagra
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-circle"></i>
            <span class="badge">en-au</span>
            Karan S. Sisodia
        </a>
    </div>
</div>

<div class="col-lg-8 col-md-8" id="chat_box">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-weixin"></i> <span>Chat</span>
            <!--	    <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                                        </span>Refresh</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                                        </span>Available</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                                        </span>Busy</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                        Away</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                        Sign Out</a></li>
                            </ul>
                        </div>-->
        </div>
        <div class="panel-body">
            <ul class="chat">
                <li class="left clearfix"><span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Jack Sparrow</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o"></i> 14 mins ago
                            </small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                            dolor, quis ullamcorper ligula sodales.
                        </p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="action_bar">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <button id="call_button" class="btn btn-success btn-lg" data-state="0" data-sid="anikgoel">
                            <i class="fa fa-phone"></i> <span>Call</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="chat_button" class="btn btn-success btn-lg">
                                <i class="fa fa-microphone"></i>
                            </button>
                        </span>
                        <input type="text" class="form-control input-lg" id="message" placeholder="Tap to say...">
                        <span class="input-group-btn">
                            <button id="send_button" class="btn btn-success btn-lg">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--	<div class="panel-footer action_bar">
                    
                </div>-->
    </div>
</div>

<div class="col-lg-2 col-md-2">
    <h3>
        Settings
    </h3>
    <div class="">
        <div class="from-group">
            <label for="language">
                Language
            </label>
            <select name="language" id="select_language" class="form-control" onchange="updateCountry()">
            </select>
        </div>
        <div class="from-group">
            <label for="accent">
                Accent
            </label>
            <select name="accent" id="select_dialect" class="form-control">
            </select>
        </div>
    </div>
</div>

<script type="text/html" id="message_template_me">
    <li class="right clearfix">
        <span class="chat-img pull-right">
            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
        </span>
        <div class="chat-body clearfix">
            <div class="header">
                <small class=" text-muted">
                    <i class="fa fa-clock-o"></i> 14 mins ago
                </small>
                <strong class="pull-right primary-font">Bhaumik Patel</strong>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                dolor, quis ullamcorper ligula sodales.
            </p>
        </div>
    </li>
</script>

<script type="text/html" id="message_template_u">
    <li class="left clearfix">
        <span class="chat-img pull-left">
            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
        </span>
        <div class="chat-body clearfix">
            <div class="header">
                <strong class="primary-font">Jack Sparrow</strong> 
                <small class="pull-right text-muted">
                    <i class="fa fa-clock-o"></i> 14 mins ago
                </small>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                dolor, quis ullamcorper ligula sodales.
            </p>
        </div>
    </li>
</script>

<script type="text/html" id="call_template">
    <li class="call clearfix">
        <div class="chat-body clearfix text-success">
            <div class="header">
                <small class="pull-right text-muted">
                    <i class="fa fa-clock-o"></i> 14 mins ago
                </small>
                <small class="pull-left primary-font">
                    <i class="fa fa-sign-out"></i> Bhaumik Patel
                </small>
            </div>
        </div>
    </li>
</script>