<script type="text/javascript">
    var user_id = '<?php echo $user_id; ?>';
    var user_name = '<?php echo $this->Session->read('Auth.User.name'); ?>';
    var base_url = '<?php echo str_replace(DS . $this->request->params['controller'], '',$this->Html->url()); ?>';
    var history = {};
    
    function store_history(sid, message){
	var keys = Object.keys(history);
	
	if (keys.indexOf(sid) >= 0){
	    history[sid].push(message);
	} else {
	    history[sid] = [];
	    history[sid].push(message);
	}
	
	return history;
    }
</script>