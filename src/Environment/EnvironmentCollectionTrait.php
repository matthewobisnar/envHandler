<?php
namespace EnvHandler\Environment;

use EnvHandler\Environment\EnvironmentColllectionInterface;

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
            "APP_NAME" => "null",
            "APP_URL" => "http://localhost",
            "APP_ENV" => "development",
            "separator",
            "DB_CONNECTIONS" => "pdo",
            "DB_USERNAME" => "dumpy_username",
            "DB_PASSWORD" => "dumpy_password",
            "DB_NAME" => "dump_dbname",
            "DB_HOST" => "localhost",
            "DB_PORT" => "8080",
            "separator",
            "MAILER" => "PHPMailer",
            "MAIL_MAILER" => "null",
            "MAIL_HOST" => "null",
            "MAIL_PORT" => "null",
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
    public function generateSampleFormat($fileNameExtension = ".example")
    {
        $content = "";

        if (!file_exists($this->filePath($fileNameExtension))) {

            foreach ($this->sampleFormat() as $key => $file) {

                if ($file != "separator") {
                    $content .= sprintf("%s=%s", $key, $file) . "\n";
                }

                if ($file == 'separator') {
                    $content .= "\n";
                }
            }

            $this->generateText ($content, $fileNameExtension);
        }
    }

    /**
     * Actual Creation of example file.
     * 
     * @param string
     * @return boolean
     */
    public function generateText ($content, $fileNameExtension) {

        try {

            $writeContent = fopen($this->filePath($fileNameExtension), "w");
            fwrite($writeContent, $content);
            fclose($writeContent);

        } catch(\Exception $e) {
            throw new \RuntimeException(sprintf($e->getMessage()));
        }

        return true;
    }
} 