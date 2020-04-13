<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    public function testRegularProductQualityDecreasesByOne()
    {
        $items = [new Item("foo", 2, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->name);
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testRegularProductQualityStaysAtZero()
    {
        $items = [new Item("foo", 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->name);
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testRegularProductQualityDropsAfterSellInIsZero()
    {
        $items = [new Item("foo", 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->name);
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(8, $items[0]->quality);
    }

    public function testSulfurasProductQualityStaysTheSame()
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 2, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Sulfuras, Hand of Ragnaros", $items[0]->name);
        $this->assertEquals(2, $items[0]->sell_in);
        $this->assertEquals(1, $items[0]->quality);
    }

    public function testAgedBrie()
    {
        $items = [new Item("Aged Brie", 2, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie", $items[0]->name);
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(2, $items[0]->quality);
    }

    public function testAgedBrieSellInIsOne()
    {
        $items = [new Item("Aged Brie", 0, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie", $items[0]->name);
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(3, $items[0]->quality);
    }

    public function testAgedBrieHighQualityDoesNotGetBetter()
    {
        $items = [new Item("Aged Brie", 0, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie", $items[0]->name);
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testBackstageQualityIncreasesBy3WhenSellInLessThan6()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert", $items[0]->name);
        $this->assertEquals(4, $items[0]->sell_in);
        $this->assertEquals(4, $items[0]->quality);
    }

    public function testBackstageQualityIncreasesBy2WhenSellInLessThan11AndMoreThan5()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 7, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert", $items[0]->name);
        $this->assertEquals(6, $items[0]->sell_in);
        $this->assertEquals(3, $items[0]->quality);
    }


    public function testBackstageQualityIncreasesBy1WhenSellInMoreThan10()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 11, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert", $items[0]->name);
        $this->assertEquals(10, $items[0]->sell_in);
        $this->assertEquals(2, $items[0]->quality);
    }


    public function testBackstageWhenSellInLessThanZeroQualityIsDownToZero()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert", $items[0]->name);
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }
}
