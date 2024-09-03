<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
            	<li class="dashboard">
            		<?php
            			echo $this->Html->link('<i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard',array(
							'controller'=>'approvers','action'=>'dashboard'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="approvers">
            		<?php
            			echo $this->Html->link('<i class="fa fa-info-circle m-r-10" aria-hidden="true"></i>Approval Requests',array(
							'controller'=>'approvers','action'=>'approvalRequests'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	
                <li>
            		<?php
            			echo $this->Html->link('<i class="fa fa-sign-out m-r-10" aria-hidden="true"></i>Logout',array(
							'controller'=>'approvers','action'=>'logout'
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