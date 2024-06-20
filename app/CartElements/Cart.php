<?php

namespace App\CartElements;

use App\Models\Product;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    private Collection $items;

    /**
     * @param Collection $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }


    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getTotalPrice(){
        return $this->items->sum(function($item){
            return $item->getTotalPrice();
        });
    }
    public function hasItems(): bool
    {
        return $this->items->isNotEmpty();
    }

    public function getQuantity(): int
    {
        return $this->items->sum(function ($item) {
            return $item->getQuantity();
        });
    }


    public function addItem(Product $product): Cart
    {

        $items = $this->items;
        $item = $items->first($this->ComparisonProductIdWithItemId($product));
        if(!is_null($item)){
            $items = $items->reject($this->ComparisonProductIdWithItemId($product));
            $newItem = $item->addQuantity($product);
        } else{
            $newItem = new CartItem($product);
        }

        $items->add($newItem);

        return new Cart($items);
    }

    public function removeItem(Product $product){
        $items = $this->items->reject($this->ComparisonProductIdWithItemId($product));

        return new Cart($items);
    }


    /**
     * @param Product $product
     * @return \Closure
     */
    public function ComparisonProductIdWithItemId(Product $product): \Closure
    {
        return function ($item) use ($product) {
            return $product->id == $item->getProductId();
        };
    }
}
