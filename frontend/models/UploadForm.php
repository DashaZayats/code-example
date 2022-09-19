<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

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
           //  Image::thumbnail('img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension, 50, 50)->save('img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}

