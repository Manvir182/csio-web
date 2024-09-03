<div class="row page-titles">
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
            		echo $this->Html->link('CMMC Process Maturity Rating Descriptions',array(
						'controller'=>'CmmcMaturityDescriptions','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">View or Edit</li>
        </ol>
    </div>                   
</div>

<?php echo $this->Form->create('MaturityDescriptions'); ?>
<table class="table table-bordered bg-white">
	<thead>
		<tr class="bg-info">
			<th class="text-white"> Maturity Attribute </th>
			<th class="text-white"> Maturity Option</th>
			<th class="text-white"> Description </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($descs as $data): ?>
			<?php $matr = end($data); ?>
			<?php $i=0; foreach($data as $mData): ?>
				<tr>
					<?php if($i==0): ?>
						<td rowspan="<?php echo count($data); ?>">
							<?php echo $matr['mattr']; ?>
						</td>
					<?php endif; ?>
					<td><?php echo $mData['moption_score'].' - '.$mData['moption']; ?></td>
					<td style="width:65%;">
						<?php 
							echo $this->Form->control('id.'.$mData['mdesc_id'].'',[
								'type'=>'hidden',
								'class'=>'form-control',
								'value'=>$mData['mdesc_id']
							]);
							echo $this->Form->control('description.'.$mData['mdesc_id'].'',[
								'type'=>'textarea',
								'class'=>'form-control',
								'label'=>false,
								'value'=>$mData['description']
							]);
						?>
					</td>
				</tr>
			<?php $i++; endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="text-right">
	<button class="btn btn-success" type="submit">
		<i class="fa fa-save"></i>
		Update Descriptions
	</button>
</div>
<?php echo $this->Form->end(); ?>
