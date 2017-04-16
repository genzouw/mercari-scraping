<?php

namespace Com\Genzouw;

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MercariScraper
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    public function parse()
    {
        $dom = \phpQuery::newDocument(file_get_contents(
            'http://www.mercari.com/jp/search/?keyword=%E3%82%AF%E3%83%BC%E3%83%9D%E3%83%B3'
        ));

        // pq($dom)->find('section.items-box')->find('img')->each(function ($it) {
        // pq($dom)->find('section.items-box > a > figure > img')->each(function ($it) {
        pq($dom)->find('section.items-box')
            ->each(function ($it) {
                // echo '----------------------------------------', PHP_EOL;
                // echo '', pq($it)->html(), PHP_EOL;
            })
            // ->find('img')
            // ->eq(1)
            ->each(function ($it) {
                $selector = pq($it);

                $detailPageUrl = $selector->find('a')->attr('href');
                echo "{$selector->find('h3')->text()}", PHP_EOL;
                echo "    {$detailPageUrl}", PHP_EOL;
                echo "    {$selector->find('.items-box-price')->text()}", PHP_EOL;
                echo "    {$selector->find('img')->attr('data-src')}", PHP_EOL;

                $detailPage = \phpQuery::newDocument(file_get_contents(
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

                echo '    ', implode($categories, ' > '), PHP_EOL;
                // item-buy-btn disabled f18-24

                echo '========================================', PHP_EOL;
                // echo '', $it->name(), PHP_EOL;
                // echo '', $it->attr('src'), PHP_EOL;
                // echo '', pq($it)->attr('data-src'), PHP_EOL;
                // echo '', pq($it)->data('src'), PHP_EOL;
                // echo '', pq($it)->html(), PHP_EOL;
                // echo '$ ', trim(pq($it)->find('div.command')->text()), PHP_EOL;
                // echo '', PHP_EOL;
                // echo trim(pq($it)->find('div.summary')->text()), PHP_EOL;
            });

        return true;
    }
}
