<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\Product\ImportForm;
use shop\forms\manage\Shop\Product\ModificationForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\PriceForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\forms\manage\Shop\Product\QuantityForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\Shop\TagRepository;
use shop\services\ProductReader;
use shop\services\TransactionManager;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;
    private $transaction;
    /** @var ProductReader */
    private $reader;


    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
    }
    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);


        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            $form->description,
            $form->weight,
            $form->quantity->quantity,
            new Meta(
                'Заказать '. $form->name . ' от бренда ' . $brand->name . ' с доставкой в Чите.',
                'Купить ' . $form->name . ' => Гарантия качества => Заказ и доствка цветов в Чите => Интернет магазин Хризантема.ру',
                $form->name .', '. $category->name .', '. $brand->name . ', доставка цветов, заказ цветов, интернет-магазин, доставка в Чите '
            )
        );

        $product->setPrice($form->price->new, $form->price->old);



        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        foreach ($form->photos->files as $file) {
            $product->addPhoto($file);
        }

        if (!empty($form->tags->existing)){
            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $product->assignTag($tag->id);
            }
        }


        $this->transaction->wrap(function () use ($product, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }

                $product->assignTag($tag->id);
            }
            $this->products->save($product);
        });
        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->description,
            $form->weight,
            new Meta(
                'Заказать '. $form->name . ' от бренда ' . $brand->name . ' с доставкой в Чите.',
                'Купить ' . $form->name . ' => Гарантия качества => Заказ и доствка цветов в Чите => Интернет магазин Хризантема.ру',
                $form->name .', '. $category->name .', '. $brand->name . ', доставка цветов, заказ цветов, интернет-магазин, доставка в Чите '
            )
        );

        $product->changeMainCategory($category->id);

        $this->transaction->wrap(function () use ($product, $form) {

            $product->revokeCategories();

            $product->revokeTags();

            $this->products->save($product);

            foreach ($form->categories->others as $otherId) {
                $category = $this->categories->get($otherId);
                $product->assignCategory($category->id);
            }

            foreach ($form->values as $value) {
                $product->setValue($value->id, $value->value);
            }

            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $product->assignTag($tag->id);
            }

            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }

            $this->products->save($product);
        });
    }

    public function import($id, ImportForm $form): void
    {

        $this->transaction->wrap(function () use ($form) {

            $results = $this->reader->readCsv($form->file->tempName);

            foreach ($results as $result){
                $product = $this->products->getByCode($result->code);
                $product->setPrice($result->priceNew, $result->priceOld);
                $product->setModificationPriceByCode($result->modificationCode, $result->modificationPrice);
                $this->products->save($product);
            }

        });

    }


    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice($form->new, $form->old);
        $this->products->save($product);
    }
    public function changeQuantity($id, QuantityForm $form): void
    {
        $product = $this->products->get($id);
        $product->changeQuantity($form->quantity);
        $this->products->save($product);
    }
    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }
    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }
    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }
    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }
    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }
    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }
    public function addRelatedProduct($id, $otherId): void
    {
        //var_dump($id);exit;
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->assignRelatedProduct($other->id);
        $this->products->save($product);
    }
    public function removeRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->revokeRelatedProduct($other->id);
        $this->products->save($product);
    }
    public function addModification($id, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        //var_dump($form);exit;
        $product->addModification(
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }
    public function editModification($id, $modificationId, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->editModification(
            $modificationId,
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }
    public function removeModification($id, $modificationId): void
    {
        $product = $this->products->get($id);
        $product->removeModification($modificationId);
        $this->products->save($product);
    }
    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }

}