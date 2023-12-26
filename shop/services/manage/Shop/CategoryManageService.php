<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Category;
use shop\forms\manage\Shop\CategoryForm;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\ProductRepository;
use yii\helpers\Inflector;

class CategoryManageService
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }
//for Inflector install php-intl mod
    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug ?: Inflector::slug($form->name),
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        if ($form->parentId !== $category->parent->id){
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function moveUp($id):void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);

        if ($prev = $category->prev){
            $category->insertBefore($prev);
        }
        $this->categories->save($category);

    }

    public function moveDown($id):void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);

        if ($next = $category->next){
            $category->insertAfter($next);
        }
        $this->categories->save($category);

    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existsByMainCategory($category->id)){
            throw new \DomainException('Вы не можете удалить эту категорию, она имеет товары.');
        }
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category):void
    {
        if ($category->isRoot()){
            throw new \DomainException('Unable to manage the root category.');
        }
    }

}