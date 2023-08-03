<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/23/2023
 * Time: 3:56 PM
 */
class Service extends mg2Base
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post, 'full');
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
}