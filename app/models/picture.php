<?php

class Picture
{
    protected static $allowed_extensions = array("jpg", "jpeg", "gif", "png");

    public static function upload($file, $path_name)
    {
        if (!move_uploaded_file($file['tmp_name'], $path_name)) {
            throw new AppException('Cannot upload specified file');
        }
    }

    public static function get($name)
    {
        return array_key_exists($name, $_FILES) ? $_FILES[$name] : null;
    }

    public static function getUploadPath($picture_file)
    {
        return (!$picture_file) ? null : IMAGE_UPLOADS_DIR . date('YmdHis') . '.'.
            self::getExtension($picture_file['name']);
    }

    public static function getExtension($filename)
    {
        if (!$filename) {
            return null;
        }

        $filename_parts = explode('.', $filename);
        $extension = end($filename_parts);
        if (!in_array($extension, self::$allowed_extensions)) {
            throw new AppException('file name extension is not allowed');
        }
        return $extension;
    }
}
