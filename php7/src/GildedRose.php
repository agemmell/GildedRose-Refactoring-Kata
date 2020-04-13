<?php

namespace App;

final class GildedRose
{

    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                    $item->sell_in--;
                    if ($item->sell_in < 0 && $item->quality < 50) {
                        $item->quality++;
                    }
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    if ($item->sell_in <= 0) {
                        $item->quality = 0;
                    } elseif ($item->quality < 50) {
                        $item->quality++;
                        if ($item->quality < 50 && $item->sell_in < 11) {
                            $item->quality++;
                        }
                        if ($item->quality < 50 && $item->sell_in < 6) {
                            $item->quality++;
                        }
                    }
                    $item->sell_in--;
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    // Never changes!
                    break;
                case 'Conjured':
                    if ($item->quality > 0) {
                        $item->quality -= 2;
                    }
                    if ($item->sell_in <= 0 && $item->quality > 0) {
                        $item->quality -= 2;
                    }
                    $item->sell_in--;
                    break;
                default:
                    if ($item->quality > 0) {
                        $item->quality--;
                    }
                    if ($item->sell_in <= 0 && $item->quality > 0) {
                        $item->quality--;
                    }
                    $item->sell_in--;
            }
        }
    }
}

