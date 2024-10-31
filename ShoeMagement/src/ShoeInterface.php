<?php

namespace ShoeManagement;

interface ShoeInterface {
    public function getBrand(): string;
    public function getModel(): string;
}
