<div class="col-lg-3 col-md-3 col-xs-12 col-lg-offset-4 col-md-offset-4">
    <div class="panel panel-primary margin_top">
	<div class="panel-heading">
	    <h4>
		Register
	    </h4>
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
	    echo $this->Form->input("username", array('placeholder' => 'username'));
	    echo $this->Form->input("key", array('type' => 'password', 'placeholder' => 'your returning key'));
	    ?>
	    <div class="row">
		<div class="col-lg-3 col-md-3">
		    <label>Gender</label>
		</div>
		<div class="col-lg-9 col-md-9">
		    <label class="radio-inline">
			<?php
			echo $this->Form->radio("gender", array('m' => 'Male'), array('label' => FALSE));
			?>
		    </label>
		    <label class="radio-inline">
			<?php
			echo $this->Form->radio("gender", array('f' => 'Female'), array('label' => FALSE));
			?>
		    </label>
		</div>
	    </div>
	    <?php
	    $options = array(
		'label' => 'Register',
		'div' => array(
		    'class' => 'form-group',
		),
		'class' => 'btn btn-success'
	    );
	    echo $this->Form->end($options);
	    ?>
	</div>
    </div>
</div>