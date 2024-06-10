<?php

namespace App\CartElements;


use App\Models\Product;

class CartItem
{
    private int $productId;
    private string $name;
    private float $price;
    private ?string $imagePath;
    private int $quantity = 0;

    /**
     * @param int $productId
     * @param string $name
     * @param float $price
     * @param string|null $imagePath
     *  @param int $quantity
     */
    public function __construct(Product $product, int $quantity = 1)
    {
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->imagePath = $product->image_path;
        $this->quantity += $quantity;
    }


    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getQuantity(): int
    {
        return $this->quantity;
    }


    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotalPrice(){
        return $this->price * $this->quantity;
    }
    public function getImage(){
        if(!is_null($this->imagePath)){
            return asset("storage/" . $this->getImagePath());
        }else{
            return "https://dummyimage.com/600x700/dee2e6/6c757d.jpg";
        }
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function addQuantity(Product $product): CartItem
    {
        return new CartItem($product, ++$this->quantity);
    }
}
