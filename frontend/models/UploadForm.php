<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $file = $this->imageFile->baseName . '.' . $this->imageFile->extension;
            Image::thumbnail('img/' . $file, 110, 110)->save('img/' . $file, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}

