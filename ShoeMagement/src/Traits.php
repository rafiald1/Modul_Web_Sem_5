<?php

namespace ShoeManagement;

trait Timestamps {
    public function createdAt() {
        return date('Y-m-d H:i:s');
    }
}
