<?php


namespace shop\services\manage\Blog;


use shop\entities\Blog\Tag;
use shop\forms\manage\Blog\TagForm;
use shop\repositories\Blog\TagRepository;
use yii\helpers\Inflector;

class TagManageService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

//for Inflector install php-intl mod
    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug ?: Inflector::slug($form->name)
        );
        $this->tags->save($tag);
        return $tag;
    }

    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
    }

    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }

}