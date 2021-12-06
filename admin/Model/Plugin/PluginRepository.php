<?php

namespace Admin\Model\Plugin;

use Engine\Model;

class PluginRepository extends Model
{
    /**
     * @return mixed
     */
    public function getPlugins()
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('plugins')
            ->sql();

        return $this->db->query($sql);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getActivePlugins()
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('plugins')
            ->where('is_active', 1)
            ->sql();

        return $this->db->query($sql, $this->queryBuilder->values);
    }

    public function addPlugin($directory)
    {
        $plugin = new Plugin();
        $plugin->setDirectory($directory);

        return $plugin->save();
    }

    public function activatePlugin($id, $active)
    {
        $plugin = new Plugin($id);
        $plugin->setIsActive($active);

        return $plugin->save();
    }

    public function isInstallPlugin($directory)
    {
        $query = $this->db->query(
            $this->queryBuilder
            ->select('COUNT(id) as count')
            ->from('plugins')
            ->where('directory', $directory)
            ->limit(1)
            ->sql(),
            $this->queryBuilder->values
        );

        if ($query[0]->count > 0) {
            return true;
        }

        return false;
    }

    public function isActivePlugin($directory)
    {
        $query = $this->db->query(
            $this->queryBuilder
                ->select('COUNT(id) as count')
                ->from('plugins')
                ->where('directory', $directory)
                ->where('is_active', 1)
                ->limit(1)
                ->sql(),
            $this->queryBuilder->values
        );

        if ($query[0]->count > 0) {
            return true;
        }

        return false;
    }
}