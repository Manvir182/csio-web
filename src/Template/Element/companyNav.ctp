<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
            	<li class="dashboard">
            		<?php
            			echo $this->Html->link('<i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard',array(
							'controller'=>'companies','action'=>'dashboard'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="employees">
            		<?php
            			echo $this->Html->link('<i class="fa fa-users m-r-10" aria-hidden="true"></i>Employees',array(
							'controller'=>'Employees','action'=>'index'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="assessments">
            		<?php
            			echo $this->Html->link('<i class="fa fa-list-alt m-r-10" aria-hidden="true"></i>Assessments',array(
							'controller'=>'Assessments','action'=>'selfAssessments'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="approvers">
            		<?php
            			echo $this->Html->link('<i class="fa fa-users m-r-10" aria-hidden="true"></i>Approvers',array(
							'controller'=>'Approvers','action'=>'listApprovers'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
				<li class="approvers">
            		<?php
            			echo $this->Html->link('<i class="fa fa-users m-r-10" aria-hidden="true"></i> Third Party Risk Management (TPRM)',array(
							'controller'=>'Tprm','action'=>'invite'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
                <li>
            		<?php
            			echo $this->Html->link('<i class="fa fa-sign-out m-r-10" aria-hidden="true"></i>Logout',array(
							'controller'=>'users','action'=>'logout'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>