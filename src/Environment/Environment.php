<?php

namespace EnvHandler\Environment;

use EnvHandler\Environment\EnvironmentColllectionInterface;

class Environment 
{
    use EnvironmentCollectionTrait;

    /**
     * Check if env file is Generated.
     * 
     * @param void
     * @return Boolean
     */
    protected function hasEnv($throw = null)
    {
        if (file_exists($this->filePath())) {
            return true;
        }

        if (is_null($throw) || $throw == true) {
            return false;   
        }

        throw new \RuntimeException(sprintf("%s file does not exists", $this->filename));
    }

    /**
     * Check if Env file has values or not empty.
     * Return boolean true if .env is exists not empty or return a false if the does not exists. 
     * 
     * @param void
     * @return array|boolean
     */
    protected function hasEnvValue()
    {
        if ($this->hasEnv()) {

            $fileValues = file($this->filePath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (!empty($fileValues)) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Return associative array list if the file exist and not empty.
     * Return an empty array if the file exists and empty.
     * Throw runtime exception if the file does not exists.
     * 
     * @param void
     * @return array
     */
    public function getEnvFileContent()
    {
        $output = [];

        if ($this->hasEnv() && $this->hasEnvValue()) {

            $fileValues = file($this->filePath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($fileValues as $values) {

                list($key, $value) = array_pad(preg_split("/[". $this->delimeter ."]/" , $values), 2, null);

                $output[strtoupper(trim($key))] = trim($value);

            }
        }

        return $output; 
    }

    /**
     * load Env content and store to putenv if exists.
     * throw RuntimeException if file does not exists.
     * 
     * @param boolean
     * @return array
     * @throw RuntimeException;
     */
    public function load($autoGenerate = null)
    {
        if (!$this->hasEnv()) {
            if (!is_null($autoGenerate) && $autoGenerate == true) {
                $this->generateSampleFormat("");
            } else {
                throw new \RuntimeException(sprintf("%s file does not exists", $this->filename));
            }
        }

        if ($this->hasEnv()) {
            foreach ($this->getEnvFileContent() as $key => $content) {
                putenv(sprintf("%s=%s", $key, $content));
            }

            return $this;
        }
    }
    
}