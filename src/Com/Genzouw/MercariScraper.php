<?php

namespace Com\Genzouw;

use Com\Genzouw\Mercari\Item;
use Com\Genzouw\Mercari\SearchCondition;
use phpQuery;

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MercariScraper
{
    public $items = array();

    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    public function findItems(SearchCondition $searchCondition = null): array
    {
        if (is_null($searchCondition)) {
            $searchCondition = new SearchCondition();
        }
        // $searchCondition = new SearchCondition();
        // $searchCondition->setKeyword('割引券');
        // $searchCondition->setMaxPage(1);
        // $searchCondition->setOnSale(true);

        $urls = $searchCondition->generateSearchResultPageUrls();

                $options = array(
                    'http' => array(
                        'method' => 'GET',
                        'header' => 'User-Agent: Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_5 like Mac OS X; ja-jp) AppleWebKit/533.17.9 (KHTML, like Gecko) Mobile/8L1',
                    ),
                );
        $context = stream_context_create($options);

        foreach ($urls as $url) {
            $dom = phpQuery::newDocument(file_get_contents(
                $url,
                false,
                $context
            ));

            pq($dom)
                ->find('section.items-box')
                ->each(function ($it) {
                    $selector = pq($it);

                    $detailPageUrl = $selector->find('a')->attr('href');

                    $detailPage = phpQuery::newDocument(file_get_contents(
                        $detailPageUrl
                    ));

                    $detailTable = pq($detailPage)
                        ->find('section.item-box-container > div.item-main-content.clearfix > table');

                    $categories = [];
                    $detailTable
                        ->find('tr:nth-child(2) > td div')
                        ->each(function ($it) use (&$categories) {
                            $categories[] = pq($it)->text();
                        });

                    $disabled = $detailTable
                        ->find('div.item-buy-btn')
                        ->hasClass('disabled');

                    $item = new Item();
                    $item
                        ->setName($selector->find('h3')->text())
                        ->setImageUrl($selector->find('img')->attr('data-src'))
                        ->setPrice(intval(preg_replace('/[^0-9]/su', '', $selector->find('.items-box-price')->text())))
                        ->setCategories(implode($categories, ' > '))
                        ->setOnSale($disabled ? '売り切れ' : '販売中')
                        ->setDetailPageUrl($detailPageUrl);

                    $this->items[] = $item;
                });
        }

        return $this->items;
    }
}