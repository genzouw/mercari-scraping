<?php

namespace Com\Genzouw\Mercari;

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class SearchCondition
{
    private $maxPage = 1;

    private $keyword = '';

    private $onSale = null;

    private $priceMax = 0;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    public function setPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;
    }

    public function getPriceMax()
    {
        return $this->priceMax;
    }

    public function setOnSale(bool $onSale)
    {
        $this->onSale = $onSale;
    }

    public function getOnSale(): bool
    {
        return $this->onSale;
    }

    public function setMaxPage(int $maxPage)
    {
        $this->maxPage = $maxPage;
    }

    public function getMaxPage(): int
    {
        return $this->maxPage;
    }

    public function setKeyword(string $keyword)
    {
        $this->keyword = $keyword;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function generateSearchResultPageUrls()
    {
        $urls = array();

        for ($i = 0, $size = $this->maxPage; $i < $size; $i++) {
            $queryStrings = array(
                'page=' . ($i + 1),
            );

            if (!is_null($this->onSale)) {
                $queryStrings[] = 'status_on_sale=' . ($this->onSale ? '1' : '0');
            }

            if (!empty($this->keyword)) {
                $queryStrings[] = 'keyword=' . rawurlencode($this->keyword);
            }

            if (!empty($this->priceMax) && $this->priceMax > 0) {
                $queryStrings[] = 'price_max=' . "{$this->priceMax}";
            }

            $urls[] = 'https://www.mercari.com/jp/search/?' . implode($queryStrings, '&');
        }

        return $urls;
    }
}