<?php
require '/home/ubuntu/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

echo  "---Starting the PHP script--- -> ". "\n";
if(isset($_POST["submit"])){

  // Hard-coded credentials
  // TODO: Change to utilize credentials in environmental variables
  $s3Client = new S3Client([
      'version'     => 'latest',
      'region'      => 'aws_region_of_the_bucket',
      'credentials' => [
          'key'    => 'your_aws_access_keyname',
          'secret' => 'your_aws_secretkey',
      ],
  ]);

  $b_name = 'your_s3_bucket_name';

  $f_path = ($_FILES["fileToUpload"]["tmp_name"]);
  $f_name = basename($_FILES["fileToUpload"]["name"]);
  echo  "---Uploading file " . $f_name . " to the S3 bucket--- -> " . "\n";
  try {
      $result = $s3Client->putObject([
          'Bucket' => $b_name,
          'Key' => $f_name,
          'SourceFile' => $f_path,
      ]);
  }
  catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
        echo  "---Ending the script---" . "\n";
        exit();
  }
  echo  "---Upload finished successfully--- ->" . "\n";

}

echo  "---Ending the script---" . "\n";
?>
