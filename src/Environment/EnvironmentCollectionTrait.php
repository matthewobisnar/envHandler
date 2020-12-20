<?php
namespace EnvHander\Environment;

use EnvHander\Environment\EnvironmentColllectionInterface;

trait EnvironmentCollectionTrait
{
    /**
     * Application base directory.
     * __DIR__
     * 
     * @var string
     */
    public $basePath;

    /**
     * Name of env file.
     * 
     * @var string
     */
    public $filename = '.env';

    /**
     * Regex delimeter for split env value to kay value pair.
     * 
     * @var string
     */
    public $delimeter = "=:";

    /**
     * Call magic method construct
     * 
     * @param string
     */
    public function __construct($path)
    {
        $this->basePath = $path;
        $this->generateSampleFormat();
    }
    
    /**
     * Return static array sample format of env
     * 
     * @param void
     * @return array
     */
    public function sampleFormat()
    {
        return [
            "APP_NAME" => "Bisnar",
            "APP_URL" => "http",
            "APP_ENV" => "production",
            "separator",
            "DB_CONNECTIONS" => "pdo",
            "DB_USERNAME" => "matthew",
            "DB_PASSWORD" => "root",
            "DB_NAME" => "mysql",
            "DB_HOST" => "localhost",
            "DB_PORT" => "8080",
            "separator",
            "MAILER" => "PHPMailer",
            "MAIL_MAILER" => "smtp",
            "MAIL_HOST" => "smtp.mailtrap.io",
            "MAIL_PORT" => 2525,
            "MAIL_USERNAME" => "null",
            "MAIL_PASSWORD" => "null",
            "MAIL_ENCRYPTION" => "null",
            "MAIL_FROM_ADDRESS" => "null",
            "MAIL_FROM_NAME" => "null",
        ];
    }

    /**
     * Return full path of env example file.
     * 
     * @param string
     * @return string
     */
    public function filePath($extenstion = null)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $this->filename . $extenstion;
    }

    /**
     * Generate example format of .env if example file exists.
     * 
     * @param void
     * @return void
     */
    public function generateSampleFormat()
    {
        if (!file_exists($this->filePath(".example"))) {

            $content = "";

            foreach ($this->sampleFormat() as $key => $file) {

                if ($file != "separator") {
                    $content .= sprintf("%s=%s", $key, $file) . "\n";
                }

                if ($file == 'separator') {
                    $content .= "\n";
                }
            }

            $this->generateText ($content);
        }
    }

    /**
     * Actual Creation of example file.
     * 
     * @param string
     * @return boolean
     */
    public function generateText ($content) {

        try {

            $writeContent = fopen($this->filePath(".example"), "w");
            fwrite($writeContent, $content);
            fclose($writeContent);

        } catch(\Exception $e) {
            throw new \RuntimeException(sprintf($e->getMessage()));
        }

        return true;
    }
} 