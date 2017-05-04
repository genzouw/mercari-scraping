#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * @author   genzouw <genzouw@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package
 */

use Com\Genzouw\MercariScraper;
use Com\Genzouw\Mercari\SearchCondition;
use Com\Genzouw\Mercari\Item;

$scraper = new MercariScraper();

$keyword = $argv[1];

$condition = new SearchCondition();
$condition->setKeyword($keyword);
$condition->setMaxPage(10);
$condition->setOnSale(true);

$items = $scraper->findItems($condition);

uasort($items, function ($x, $y) {
    return $x->getPrice() - $y->getPrice();
})

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <title>Top - メルカリ</title>
        <style>
        footer {
            margin-top: 1em;
            background-color: #f5f5f5;
            text-align: center;
        }
        </style>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <a class="navbar-brand" href="">メルカリ</a>
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".target">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse target">
                <ul class="nav navbar-nav">
                    <li><a href="">Link1</a></li>
                    <li><a class="active" href="">Link2</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);"></a></li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <h2>Top</h2>

            <table class="table table-striped table-bordered table-condensed">
                 <tbody>
<?php
foreach ($items as $item) {
    echo "<tr>", PHP_EOL;
    echo "<td><a href='{$item->getDetailPageUrl()}'>{$item->getName()}</a></td>" , PHP_EOL;
    echo "<td><img style='width: 30%;' src='{$item->getImageUrl()}' /></td>" , PHP_EOL;
    echo "<td style='text-align: right'>{$item->getPrice()}</td>" , PHP_EOL;
    echo "<td>{$item->getCategories()}</td>" , PHP_EOL;
    // echo "<td>{$item->getOnSale()}</td>" , PHP_EOL;
                    // ->setName($selector->find('h3')->text())
                    // ->setImageUrl($selector->find('img')->attr('data-src'))
                    // ->setPrice(intval(preg_replace('/[^0-9]/su', '', $selector->find('.items-box-price')->text())))
                    // ->setCategories(implode($categories, ' > '))
                    // ->setOnSale($disabled ? "売り切れ" : "販売中")
                    // ->setDetailPageUrl($detailPageUrl);
    echo "</tr>", PHP_EOL;
}
?>
                 </tbody>
            </table>
        </div>

        <footer id="footer">
            <p>Copyright © 2014-2014 genzouw All Rights Reserved.</p>
            <p>( twitter:<a href="https://twitter.com/genzouw">@genzouw</a> , facebook:<a href="https://www.facebook.com/genzouw">genzouw</a>, mailto:<a href="mailto:genzouw@gmail.com">genzouw@gmail.com</a> )</p>
        </footer>

        <!-- Latest compiled and minified JavaScript -->
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>