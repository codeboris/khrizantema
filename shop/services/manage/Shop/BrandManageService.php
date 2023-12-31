<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Brand;
use shop\forms\manage\Shop\BrandForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\ProductRepository;
use yii\helpers\Inflector;


class BrandManageService
{
    private $brands;
    private $products;

    public function __construct(BrandRepository $brands, ProductRepository $products)
    {
        $this->brands = $brands;
        $this->products = $products;
    }

    //for Inflector install php-intl mod
    public function create(BrandForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            $form->slug ?: Inflector::slug($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
        return $brand;
    }

    public function edit($id, BrandForm $form): void
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
    }

    public function remove($id): void
    {
        $brand = $this->brands->get($id);
        if ($this->products->existsByBrand($brand->id)){
            throw new \DomainException('Невозможно удалить Бренд, у него есть товары.');
        }
        $this->brands->remove($brand);
    }



}