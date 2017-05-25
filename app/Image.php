<?php


namespace App;

use vendor\toolkit\AcImage;

class Image
{
    /**
     * Путь до корневого каталога картинок
     */
    const PATH = ROOT . '/templates/img/';
    /**
     * Хранит пути для хранения картинок
     * @var array
     */
    protected $savepaths = [];
    /**
     * @var Значение ширины изображения
     */
    protected $width;
    /**
     * @var Значение высоты изображения
     */
    protected $height;

    public function __construct($id)
    {
        $this->savepaths = array(
            'original' => static::PATH . 'original/' . $id . '.jpg',
            'big' => static::PATH . 'big/' . $id . '.jpg',
            'recommended' => static::PATH . 'recommended/' . $id . '.jpg',
            'small' => static::PATH . 'small/' . $id . '.jpg');
    }

    /**
     * Принимает изображение и проделывает все необходимые манипуляции
     * @param $filename Имя файла
     */
    public function saveImg($image)
    {
        list($this->width, $this->height) = getimagesize($image);

        if ($this->checkRatio()) {

            $img = AcImage::createImage($image);

            if ($img) {
                //Разрешаает перезапись файлов
                AcImage::setRewrite(true);

                $img
                    ->save($this->savepaths['original'])
                    ->resizeByHeight(450)
                    ->cropCenter(500, 350)
                    ->save($this->savepaths['big'])
                    ->resizeByWidth(290)
                    ->cropCenter(290, 130)
                    ->save($this->savepaths['recommended']);

                $img = AcImage::createImage($image);
                $img
                    ->resizeByHeight(350)
                    ->thumbnail(150, 150)
                    ->cropCenter(75, 75)
                    ->save($this->savepaths['small']);

            }
        } else {

            $img = AcImage::createImage($image);
            if ($img) {
                AcImage::setRewrite(true);
                $img
                    ->save($this->savepaths['original'])
                    ->thumbnail(500, 350)
                    ->cropCenter(500, 350)
                    ->save($this->savepaths['big'])
                    ->thumbnail(290, 130)
                    ->cropCenter(290, 130)
                    ->save($this->savepaths['recommended'])
                    ->thumbnail(90, 90)
                    ->cropCenter(75, 75)
                    ->save($this->savepaths['small']);
            }
        }
    }

    /**
     * Проверяет разницу между шириной и высотой изображения
     * @return bool
     */
    protected function checkRatio()
    {
        if ($this->width >= ($this->height * 2)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет файлы на наличие, если они существуют, удаляет их
     * метод нужен для перезаписи файлов
     * @return bool
     */

}






