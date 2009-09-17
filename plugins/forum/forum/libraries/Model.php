<?php

class Model {
    function Model() {
        $this->db = Database::getInstance();
    }
}