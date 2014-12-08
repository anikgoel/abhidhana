<?php
echo $this->Html->script(array(
    'Translations/languages.js?v=1.0',
    'Translations/SpeechToText.js?v=1.0',
    'Translations/TextToSpeech.js?v=1.0',
    'http://cdn.pubnub.com/pubnub-3.7.1.min.js',
    'Chats/pubnub.js?v=1.0',
    'Chats/index.js?v=1.0',
    'Chats/plaintext.js?v=1.0',
), array('inline' => FALSE))
?>

<div class="col-lg-2 col-md-2">
    <h3>
        Online Users
    </h3>
    <div class="list-group online_users" id="online_container">
	<!--Left Blank Intentionally-->
    </div>
</div>

<div class="col-lg-8 col-md-8" id="chat_box">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-weixin"></i> <span>Chat</span>
        </div>
        <div class="panel-body">
            <ul class="chat">
                <!--Left Blank Intentionally-->
            </ul>
        </div>
        <div class="action_bar">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <button id="call_button" class="btn btn-success btn-lg" data-state="0" data-sid="">
                            <i class="fa fa-phone"></i> <span>Call</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="chat_button" class="btn btn-success btn-lg" data-state="0">
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
	<a id="logout" class="pull-right" href="<?php echo $this->Html->url(array('controller'=> 'users', 'action'=>'logout')); ?>">
	    <i class="fa fa-sign-out"></i>
	</a>
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

<div class="modal fade" id="incoming">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h4 class="modal-title">Incoming Call</h4>
	    </div>
	    <div class="modal-body name">
		Who is calling
	    </div>
	    <div class="modal-footer">
		<button type="button" class="btn btn-danger reject" data-dismiss="modal">Reject</button>
		<button type="button" class="btn btn-success accept">Accept</button>
	    </div>
	</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="outgoing">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h4 class="modal-title">Outgoing Call</h4>
	    </div>
	    <div class="modal-body name">
		I am calling
	    </div>
	    <div class="modal-footer">
		<button type="button" class="btn btn-danger reject" data-dismiss="modal">Reject</button>
	    </div>
	</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/html" id="message_template_me">
    <li class="right clearfix">
        <span class="chat-img pull-right">
            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
        </span>
        <div class="chat-body clearfix">
            <div class="header">
<!--                <small class=" text-muted">
                    <i class="fa fa-clock-o"></i> 14 mins ago
                </small>-->
                <strong class="pull-right primary-font"><%= name %></strong>
            </div>
            <p><%= text %></p>
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
                <strong class="primary-font"><%= name %></strong> 
<!--                <small class="pull-right text-muted">
                    <i class="fa fa-clock-o"></i> 14 mins ago
                </small>-->
            </div>
            <p><%= text %></p>
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

<script type="text/html" id="online_template">
    <% _.each(users, function(user){ %>
	<a href="javascript:void(0);" class="list-group-item online" data-sid="<%= user.User.id %>" data-name="<%= user.User.name %>">
	    <i class="fa fa-circle"></i>
	    <%= user.User.name %>
	</a>
    <% }); %>
</script>