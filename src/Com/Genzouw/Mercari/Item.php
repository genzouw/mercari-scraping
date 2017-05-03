<?php

namespace Com\Genzouw\Mercari;

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Item
{
    private $name = '';

    private $imageUrl = '';

    private $price = -1;

    private $categories = '';

    private $onSale = false;

    private $detailPageUrl = '';

    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setCategories(string $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function getCategories(): string
    {
        return $this->categories;
    }

    public function setOnSale(bool $onSale)
    {
        $this->onSale = $onSale;

        return $this;
    }

    public function getOnSale(): bool
    {
        return $this->onSale;
    }

    public function setDetailPageUrl(string $detailPageUrl)
    {
        $this->detailPageUrl = $detailPageUrl;

        return $this;
    }

    public function getDetailPageUrl(): string
    {
        return $this->detailPageUrl;
    }
}
