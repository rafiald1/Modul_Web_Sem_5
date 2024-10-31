<?php

namespace ShoeManagement;

class ShoeStore {
    private $shoes = [];

    public function addShoe(Shoe $shoe) {
        $this->shoes[] = $shoe;
    }

    public function listShoes() {
        foreach ($this->shoes as $shoe) {
            echo "Brand: " . $shoe->getBrand() . "<br>";
            echo "Model: " . $shoe->getModel() . "<br>";
            echo "Category: " . $shoe->getCategory() . "<br>";
            echo "Added on: " . $shoe->createdAt() . "<br><br>";
        }
    }
}
