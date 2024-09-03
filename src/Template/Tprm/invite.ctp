<style>
/**********/

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.hide {
  display: none;
}

pre {
  margin: 0 !important;
  display: inline-block;
}

.token.operator,
.token.entity,
.token.url,
.language-css .token.string,
.style .token.string,
.token.variable {
  background: none;
}

input
 {
  height: 35px;
  margin: 0;
  padding: 6px 12px;
  border-radius: 2px;
  font-family: inherit;
  font-size: 100%;
  color: inherit;
}

input[disabled],
button[disabled] {
  background-color: #eee;
}

input,
select {
  border: 1px solid #CCC;
  /*width: 250px;*/
}

::-webkit-input-placeholder {
  color: #BBB;
}

::-moz-placeholder {
  /* Firefox 19+ */
  color: #BBB;
  opacity: 1;
}

:-ms-input-placeholder {
  color: #BBB;
}


#result {
  margin-bottom: 100px;
}


.cover-box .intl-tel-input {

    width: 100%;
}
</style>

<!-- <div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'users','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php
            		echo $this->Html->link('Tprm',array(
						'controller'=>'Tprm','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Invite</li>
        </ol>
    </div>
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php

				echo $this->Html->link('<i class="fa fa-list-alt"></i> Invite ',array(
					'controller'=>'tprm','action'=>'invite'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
    		?>

    	</div>
    </div>
</div> -->

<div class="row">
<!-- Column -->
<div class="col-lg-3 col-xlg-3 col-md-1"></div>
<div class="col-lg-6 col-xlg-6 col-md-10">
    <div class="card" style="border:1px solid #ccc;">
        <div class="card-header">
           <div class="row">
               <div class="col-md-8">
                  Invite New User
               </div>
                <div class="col-md-4 text-right">

               </div>
            </div>
        </div>
        <div class="card-block">
        	<?= $this->Form->create("inviteNewUser") ?>
        	<?php
        		$this->Form->setTemplates([
				    'inputContainer' => '<div class="col-md-6 m-t-20">
				        {{content}} </div>'
				]);
        	?>
        		<div class="row p20">
                    <?php
			             echo $this->Form->control('company_name',array(
							'class'=>'form-control',
							'required'=>true,
							'label'=>array('class'=>'cl-font-13','text'=>'Company Name')
						));
						echo $this->Form->control('company_email',array(
							'class'=>'form-control',
							'required'=>true,
							'label'=>array('class'=>'cl-font-13','text'=>'Company Email')
						));

						echo $this->Form->control('assessment_type',array(
							'class'=>'form-control',
							'required'=>true,
							'label'=>array('class'=>'cl-font-13','text'=>'Assessment Type'),
							'options'=>array(''=>'-- Select --','Generalized'=>'Generalized Assessment','Regulated'=>'Regulated Assessment','FFIEC Regulated'=>'FFIEC Regulated Assessment','Other'=>'Other Assessment'),
						));

			        ?>

		    		<div class="col-md-12 m-t-20">
		    			<?= $this->Form->button(__('Invite'),array('class'=>'btn btn-warning')) ?>
		    		</div>
		    		</div>
		    		<?= $this->Form->end() ?>
        </div>
    </div>
   </div>
</div>
