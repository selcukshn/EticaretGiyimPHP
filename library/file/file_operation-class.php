<?php

namespace file;

class file_operation
{
    private const IMAGE_EXTENSIONS = ["jpg", "jpeg", "png", "webp"];

    private static function checkExtension($extension, $allowed)
    {
        if (in_array(strtolower($extension), $allowed)) {
            return false;
        } else {
            return true;
        }
    }

    static function save_image($file, $imageName, $saveLocation, int $maxSize = 6000000, array $allowedExtensions = self::IMAGE_EXTENSIONS)
    {
        if ($file["error"] == 4) {
            return [true, "boş olamaz"];
        }

        $tempPath = $file["tmp_name"];
        $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
        $fileName = $imageName . "-" .  uniqid() . "." . $fileExtension;
        $savePath = "$saveLocation" . $fileName;

        if ($file["size"] > $maxSize) {
            return [true, "Dosya boyutu en fazla " . ($maxSize / 1000000) . "MB olabilir"];
        }
        if (file_exists(false)) {
            return [true, "Bu dosya zaten mevcut"];
        }
        if (self::checkExtension($fileExtension, $allowedExtensions)) {
            return [true, "Dosya uzantısı yalnızca '" . implode(",", $allowedExtensions) . "' uzantılı olabilir"];
        }
        if (move_uploaded_file($tempPath, $savePath)) {
            return [false, $fileName];
        } else {
            return [true, "Dosya yüklenirken bilinmeyen bir hata oluştu"];
        }
    }
    static function save_image_multiple($file, $imageName, $saveLocation, int $maxSize = 6000000, array $allowedExtensions = self::IMAGE_EXTENSIONS)
    {
        $fileNames = [];
        foreach ($file["tmp_name"] as $key => $value) {
            if ($file["error"][$key] == 4) {
                return [true, "boş olamaz"];
            }

            $tempPath = $file["tmp_name"][$key];
            $fileExtension = pathinfo($file["name"][$key], PATHINFO_EXTENSION);
            $fileName = $imageName . "-" . uniqid() . "." . $fileExtension;
            $savePath = "$saveLocation" . $fileName;

            if ($file["size"][$key] > $maxSize) {
                return [true, "Dosya boyutu en fazla " . ($maxSize / 1000000) . "MB olabilir"];
            }
            if (file_exists(false)) {
                return [true, "Bu dosya zaten mevcut"];
            }
            if (self::checkExtension($fileExtension, $allowedExtensions)) {
                return [true, "Dosya uzantısı yalnızca '" . implode(",", $allowedExtensions) . "' uzantılı olabilir"];
            }
            if (move_uploaded_file($tempPath, $savePath)) {
                array_push($fileNames, $fileName);
            } else {
                return [true, "Dosya yüklenirken bilinmeyen bir hata oluştu"];
            }
        }
        return [false, $fileNames];
    }

    static function delete_image($imageLocation, $imageName)
    {
        unlink($imageLocation . $imageName);
    }
}
