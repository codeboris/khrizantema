<?php


namespace shop\forms\manage;


use shop\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $description;
    public $keywords;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta){
            $this->title = $meta->title;
            $this->description = $meta->description;
            $this->keywords = $meta->keywords;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['title', 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
        ];
    }


}