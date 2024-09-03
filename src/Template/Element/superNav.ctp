<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
            	<li class="dashboard">
            		<?php
            			echo $this->Html->link('<i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard',array(
							'controller'=>'users','action'=>'dashboard'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="companies">
            		<?php
            			echo $this->Html->link('<i class="fa fa-bank m-r-10" aria-hidden="true"></i>Companies',array(
							'controller'=>'Companies','action'=>'index'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="companies">
            		<?php
            			echo $this->Html->link('<i class="fa fa-users m-r-10" aria-hidden="true"></i>Registration Requests',array(
							'controller'=>'Companies','action'=>'companyRequests'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
            	<li class="assessments">
            		<?php
            			echo $this->Html->link('<i class="fa fa-list-alt m-r-10" aria-hidden="true"></i>Assessments',array(
							'controller'=>'Assessments','action'=>'listAssessments'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li>
				<!-- <li class="assessments">
            		<?php
            			echo $this->Html->link('<i class="fa fa-list-alt m-r-10" aria-hidden="true"></i>Blog',array(
							'controller'=>'articles','action'=>'index'
						),array(
							'escape'=>false,'class'=>'waves-effect'
						));
            		?>
            	</li> -->
            	<li class="dropdown">
                    <a href="JavaScript:void(0)" class="waves-effect"><i class="fa fa-cog m-r-10" aria-hidden="true"></i><label class="label-text">Masters</label> <span class="caret"> <i class="fa fa-caret-down"></i></span></a>
                    <div class="dropdown-content">
                    	<?php
                        	echo $this->Html->link('Risk Domains',array(
								'controller'=>'Risks','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Regulatory Bodies',array(
								'controller'=>'RegulatoryBodies','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Generalized Control Areas',array(
								'controller'=>'GenControls','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Generalized R C Mapping',array(
								'controller'=>'GenControls','action'=>'rcmappings'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('FFIEC R C Mapping',array(
								'controller'=>'FfiecDomains','action'=>'rcmappings'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Maturity Attributes',array(
								'controller'=>'MaturityAttributes','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Maturity Options',array(
								'controller'=>'MaturityAttributeOptions','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Maturity Descriptions',array(
								'controller'=>'MaturityDescriptions','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('CMMC Maturity Attributes',array(
								'controller'=>'CmmcMaturityAttributes','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('CMMC Maturity Options',array(
								'controller'=>'CmmcMaturityAttributeOptions','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('CMMC Maturity Descriptions',array(
								'controller'=>'CmmcMaturityDescriptions','action'=>'index'
							));
                        ?>
                        <?php
                        	echo $this->Html->link('Compliance Statuses',array(
								'controller'=>'ComplianceStatuses','action'=>'index'
							));
                        ?>

                        <?php
                        	echo $this->Html->link('Risk Severity Scales',array(
								'controller'=>'RiskSeverityScales','action'=>'index'
							));
                        ?>

                        <?php
                        	echo $this->Html->link('Company Activities',array(
								'controller'=>'Activities','action'=>'index'
							));
                        ?>

                        <?php
                        	/*
                        	echo $this->Html->link('Departments',array(
								'controller'=>'Departments','action'=>'index'
							));*/
                        ?>

                    </div>
                </li>
                 <li>
            		<?php
            			echo $this->Html->link('<i class="fa fa-users m-r-10" aria-hidden="true"></i>Super Admins',array(
							'controller'=>'users','action'=>'index'
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