<?php
namespace Admin\Model\Setting;

use Engine\Model;

class SettingRepository extends Model
{
    public function getSettings()
    {
        $sql = $this->queryBuilder->select()
            ->from('setting')
            ->where('section', 'general')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql, $this->queryBuilder->values);
    }

    /**
     * @param $keyField
     * @return string
     */
    public function getSettingValue($keyField)
    {
        $sql = $this->queryBuilder->select('value')
            ->from('setting')
            ->where('key_field', $keyField)
            ->sql();

        $query = $this->db->query($sql, $this->queryBuilder->values);

        foreach ($query as $value) {
            foreach ($value as $key){
                if (isset($key)) {
                    return $key;
                } else{
                    return null;
                }
            }
        }
    }

    public function update(array $params)
    {
        if (!empty($params))
        {
            foreach ($params as $key => $value) {
                $sql = $this->queryBuilder
                    ->update('setting')
                    ->set(['value' => $value])
                    ->where('key_field', $key)
                    ->sql();

                $this->db->execute($sql, $this->queryBuilder->values);
            }
        }
    }

    /**
     * @param $theme
     */
    public function updateActiveTheme($theme)
    {
        $sql = $this->queryBuilder
            ->update('setting')
            ->set(['value' => $theme])
            ->where('key_field', 'active_theme')
            ->sql();

        $this->db->execute($sql, $this->queryBuilder->values);
    }
}