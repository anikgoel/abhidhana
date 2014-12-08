<div class="col-lg-3 col-md-3 col-xs-12 col-lg-offset-4 col-md-offset-4">
    <div class="panel panel-primary margin_top">
	<div class="panel-heading">
	    <i class="fa fa-user"></i> Register
	</div>
	<div class="panel-body">
	    <?php
	    echo $this->Form->create("User", array(
		'inputDefaults' => array(
		    'label' => false,
		    'div' => array(
			'class' => 'form-group'
		    ),
		    'class' => 'form-control'
		)
	    ));
	    
	    echo $this->Form->input("name", array('placeholder' => 'Full Name'));
	    echo $this->Form->input("username", array('placeholder' => 'Username'));
	    echo $this->Form->input("password", array('type' => 'password', 'placeholder' => 'Password'));
	    
	    $options = array(
		'label' => 'Register',
		'div' => array(
		    'class' => 'form-group',
		),
		'class' => 'btn btn-success pull-right'
	    );
	    echo $this->Form->end($options);
	    ?>
	</div>
	<div class="panel-footer">
	    Already have a account? <a href="<?php echo $this->Html->url(array('action'=>'login')); ?>" class="btn btn-link">Login</a>
	</div>
    </div>
</div>