<?php

require 's3_config.php';

try {
    $result = $s3->headBucket([
        'Bucket' => $bucketName
    ]);

    echo "<h2> S3 Connection Successful!</h2>";

} catch (Exception $e) {

    echo "<h2> Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";

}
