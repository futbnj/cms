<?php

namespace Admin\Model\Plugin;

use Engine\Core\Database\ActiveRecord;

class Plugin
{
    use ActiveRecord;

    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $directory;

    /**
     * @var
     */
    public $is_active;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param mixed $directory
     */
    public function setDirectory($directory): void
    {
        $this->directory = $directory;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     */
    public function setIsActive($is_active): void
    {
        $this->is_active = $is_active;
    }


}
