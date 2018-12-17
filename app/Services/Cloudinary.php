<?php

namespace App\Services;

class Cloudinary
{

    /**
     * @param       $filename
     * @param null  $publicId
     * @param array $options
     * @param array $tags
     *
     * @return mixed
     */
    public function upload($filename, $publicId = null, array $options, array $tags)
    {

        \Cloudder::upload($filename, $publicId, $options, $tags);

        return \Cloudder::getResult();

    }

    /**
     * @param       $publicId
     * @param array $options
     */
    public function remove($publicId, array $options)
    {

        \Cloudder::destroyImage($publicId, $options);
        \Cloudder::delete($publicId, $options);

    }

}
