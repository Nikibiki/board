<?php


namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Image extends Model
{
    public $file;


    public  function uploadFile( UploadedFile $file, $currentFile = null,   $resize = false ){
        $this->file = $file;

        if($currentFile){
            $this->deleteCurrentImage( $currentFile );
        }

        $fileName = $this->saveImage();

        if( $resize ){
            $this->resizeImage( $this->getFolder() . $fileName, $this->file );
        }

        return $fileName;
    }

    public function resizeImage( $fileName, $file ){
        $maxHeight = 150;
        $ext = ( $file->extension == 'jpg' ) ? 'jpeg' : $file->extension;
        $imagecreatefrom = 'imagecreatefrom' . $ext;
        list($width, $height) = getimagesize($fileName);

        if( $height > $maxHeight ){
            $ratio = $height / $maxHeight;
            $new_width = $width / $ratio;
            $new_height = $height / $ratio;

            $image_p = imagecreatetruecolor( $new_width, $new_height );
            $image = $imagecreatefrom( $fileName );
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $create = 'image' . $ext;
            $create($image_p, $fileName );
        }
    }


    private function getFolder(){
        return Yii::getAlias('@web') . 'img/';
    }


    private function generateFileName(){
        return strtolower( md5( uniqid($this->file->baseName) ) . '.' . $this->file->extension);
    }


    public function deleteCurrentImage( $currentFile ){
        if( $this->fileExists( $currentFile ) ){
            unlink( $this->getFolder() . $currentFile);
        }
    }

    public function deleteTmpImage( $tmpFile ){
        if( $this->fileExists( $tmpFile ) ){
            unlink( $tmpFile );
        }
    }


    public function fileExists( $currentFile ){
        return file_exists( $this->getFolder() . $currentFile ) && is_file( $this->getFolder() . $currentFile );
    }


    public function saveImage(){
        $filename = $this->generateFileName();

        $this->file->saveAs( $this->getFolder() . $filename );

        return $filename;
    }


    public static function getImage( $fileName ){
        return ( $fileName  ) ? '/img/' . $fileName : '/img/default.png';
    }
}