<?php
require __DIR__.'/vendor/autoload.php';
use Aws\Credentials\CredentialProvider;
use Aws\Textract\TextractClient;
class AwsExtract
{
    protected $client;
    public function __construct($authConfig)
    {
        // If you use CredentialProvider, it will use credentials in your .aws/credentials file.
        /*
        $provider = CredentialProvider::env();
        $client = new TextractClient([
            'profile' => 'TextractUser',
            'region' => 'us-west-2',
            'version' => '2018-06-27',
            'credentials' => $provider
        ]);
        */
        $client = new TextractClient($authConfig);
        $this->client = $client;
    }

    public function extractText($file_path){
        $client = $this->client;
        $filename = $file_path;
        $file = fopen($filename, "rb");
        $contents = fread($file, filesize($filename));
        fclose($file);
        $options = [
            'Document' => [
                'Bytes' => $contents
            ],
            'FeatureTypes' => ['FORMS'], // REQUIRED
        ];
        $result = $client->analyzeDocument($options);
// If debugging:
// echo print_r($result, true);
        $blocks = $result['Blocks'];
// Loop through all the blocks:
        $text = '';
        foreach ($blocks as $key => $value) {
            if (isset($value['BlockType']) && $value['BlockType']) {
                $blockType = $value['BlockType'];
                if (isset($value['Text']) && $value['Text']) {
                    $text = $value['Text'];
                    if ($blockType == 'WORD') {
                        $text.= "Word: ". print_r($text, true) . "\n";
                    } else if ($blockType == 'LINE') {
                        $text.= "Line: ". print_r($text, true) . "\n";
                    }
                }
            }
        }
        return $text;
    }
}
