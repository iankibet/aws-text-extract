<html>
<title>Aws Text Extract</title>
<body>
<form enctype="multipart/form-data" method="POST" action="<?php $_SERVER['PHP_SELF']  ?>">
    <input required type="file" name="file">
    <br/>
    <br/>
    <br/>
    <input type="submit" value="Extract Text">
</form>
<?php
require __DIR__.'/AwsExtract.php';
if(isset($_FILES['file'])):
$file = $_FILES['file'];
$path = $file['tmp_name'];
$authConfig = [
    'region' => '{region}',
    'version' => '{version}',
    'credentials' => [
        'key'    => '{key}',
        'secret' => '{secret}'
    ]
];
$awsTextExtract = new AwsExtract($authConfig);
$text = $awsTextExtract->extractText($path);
?>
<h3>Found Text</h3>
<div>
    <?php echo nl2br($text); ?>
</div>
<?php
endif;
?>
</body>
</html>
