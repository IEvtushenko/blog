<?php


namespace App;


trait View
{
    protected $data = [];

    /**
     * @param $k
     * @param $v
     */
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    /**
     * @property string $this->data[$property]
     * @param $k
     * @return mixed
     */
    public function __get($k)
    {
        if (isset($this->data[$k])) {
            return $this->data[$k];
        }
    }

    public function display(string $template)
    {
        echo $this->render($template);
    }

    public function render($template)
    {
        
        ob_start();
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function __isset($property)
    {
        return isset($this->data[$property]);
    }

}