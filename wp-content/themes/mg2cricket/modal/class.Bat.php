<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/23/2023
 * Time: 2:46 PM
 */
class Bat extends mg2Base
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post, 'full');
    }
}