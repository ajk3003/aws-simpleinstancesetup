<?php
require '/home/ubuntu/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

echo  "---Starting the PHP script--- -> ". "\n";
if(isset($_POST["submit"])){

  // The AWS PHP SDK will automatically check for instance IAM role
  // credentials if anything is not specified upon the S3 client creation.
  // As the EC2 instance has a role/policies assigned to it inline, in the
  // terraform code, the SDK will then utilize credentials based on that role
  //
  // Couple other options for authentication would be hardcoding the
  // credentials below or retrieving them from system variables, but utilizing
  // the role/policy setup will not require one to upload the access keys
  // to the EC2 instance or to typing them to this file directly.
  $s3Client = new S3Client([
      'version'     => 'latest',
      'region'      => 'your_aws_s3bucket_region'
  ]);

  $b_name = 'your_aws_bucket_name';

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
