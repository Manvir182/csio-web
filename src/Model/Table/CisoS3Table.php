<?php
	namespace App\Model\Table;
	
	use CakeS3\Datasource\AwsS3Table;
	
	class CisoS3Table extends AwsS3Table {
		protected static $_connectionName = 'aws_s3';
	}
