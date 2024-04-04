<?php
use Aws\S3\S3Client;

class S3Helper{
    public function __construct()
    {
        $this->objAwsS3Client = new S3Client(
            [
                'version' => 'latest',
                'region' => "ap-south-1",//$_ENV['AWS_ACCESS_REGION'],
                'credentials' => [
                    'key'    => $_ENV['awsbkey'],
                    'secret' => $_ENV['awsbskey']
                ]
            ]
        );
    }
    public function upload($tempFilePath) {
        $fileNameCmps = explode(".", $tempFilePath);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $tempFilePath) . '.' . $fileExtension;
        // try {
            $this->objAwsS3Client->putObject([
                'Bucket' => $_ENV['AWS_BUCKET_NAME'],
                'Key'    => $newFileName,
                'Body'   => fopen($tempFilePath, 'r'),
                // 'ACL'    => 'public-read'
            ]);
            $url = $this->objAwsS3Client->getObjectUrl($_ENV['AWS_BUCKET_NAME'], $newFileName);
            return $url;
        // } 
        // catch (Aws\S3\Exception\S3Exception $e) {
        //     return "There was an error uploading the file.\n";
        // }
    }
}