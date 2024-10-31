<?php

namespace ShoeManagement;

abstract class Shoe implements ShoeInterface {
    use Timestamps;

    protected $brand;
    protected $model;

    public function __construct($brand, $model) {
        $this->brand = $brand;
        $this->model = $model;
    }

    public function getBrand(): string {
        return $this->brand;
    }

    public function getModel(): string {
        return $this->model;
    }

    abstract public function getCategory(): string;
}
