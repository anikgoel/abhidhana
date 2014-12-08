<div class="col-lg-3 col-md-3 col-xs-12 col-lg-offset-4 col-md-offset-4">
    <div class="panel panel-primary margin_top">
	<div class="panel-heading">
	    <i class="fa fa-user"></i> Login
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
	    ?>
	    <?php
	    echo $this->Form->input("username", array('placeholder' => 'Username'));
	    echo $this->Form->input("password", array('type' => 'password', 'placeholder' => 'Your returning key (password)'));
	    ?>
	    <?php
	    $options = array(
		'label' => 'Login',
		'div' => array(
		    'class' => 'form-group',
		),
		'class' => 'btn btn-success pull-right'
	    );
	    echo $this->Form->end($options);
	    ?>
	</div>
	<div class="panel-footer">
	    Don't have a account yet? <a href="<?php echo $this->Html->url(array('action'=>'register')); ?>" class="btn btn-link">Register</a>
	</div>
    </div>
</div>