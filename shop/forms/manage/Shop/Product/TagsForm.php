<?php


namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * @property array $newNames
*/
class TagsForm extends Model
{
    public $existing = [];
    public $textNew;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product){
            $this->existing = ArrayHelper::getColumn($product->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'existing' => 'Существующие теги',
            'textNew' => 'Добавить новый тег'
        ];
    }

    public function tagsList(): array
    {
        return ArrayHelper::map(Tag::find()->asArray()->all(), 'id', 'name'); //orderBy('name')->
    }

    public function getNewNames():array
    {
        //return preg_split('#\s*,\s*#i', $this->textNew);
        return array_filter(array_map('trim', preg_split('#\s*,\s*#i', $this->textNew)));
    }

}