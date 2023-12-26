<?php


namespace shop\forms\manage\Shop\Product;


use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $file;

    public function rules():array
    {
        return [
            ['file', 'file', 'extensions' => ['csv']],
        ];
    }

    public function beforeValidate():bool
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstance($this, 'file');
            return true;
        }
        return false;
    }

}