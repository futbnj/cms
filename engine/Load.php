<?php

namespace Engine;

use Engine\DI\DI;

class Load
{
    const MASK_MODEL_ENTITY = '\%s\Model\%s\%s';
    const MASK_MODEL_REPOSITORY = '\%s\Model\%s\%sRepository';

    const FILE_MASK_LANGUAGE = 'Language/%s/%s.ini';

    public $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @param $modelName
     * @param false $modelDir
     * @return bool|null
     */
    public function model($modelName, $modelDir = false)
    {
        $modelName = ucfirst($modelName);
        $modelDir = $modelDir ? $modelDir : $modelName;

        $namespaceModel = sprintf(
            self::MASK_MODEL_REPOSITORY,
            ENV, $modelDir, $modelName
        );

        $isClassModel = class_exists($namespaceModel);

        if ($isClassModel) {
            $modelRegistry = $this->di->get('model') ?: new \stdClass();
            $modelRegistry->{lcfirst($modelName)} = new $namespaceModel($this->di);

            $this->di->set('model', $modelRegistry);
        }

        return $isClassModel;
    }

    /**
     * @param $path
     * @return array|false
     */
    public function language($path)
    {
        $file = sprintf(
            self::FILE_MASK_LANGUAGE,
            'english', $path
        );

        $content = parse_ini_file($file, true);

        $languageName = $this->toCamelCase($path);

        $language = $this->di->get('language') ?: new \stdClass();
        $language->{$languageName} = $content;

        $this->di->set('language', $language);

        return $content;
    }

    /**
     * @param $str
     * @return string
     */
    public function toCamelCase($str)
    {
        $replace = preg_replace('/[^a-zA-Z0-9]/', ' ', $str);
        $convert = mb_convert_case($replace, MB_CASE_TITLE);
        $result = lcfirst(str_replace(' ', '', $convert));

        return $result;
    }
}