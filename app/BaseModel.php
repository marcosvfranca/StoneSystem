<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getCreatedAtFormated()
    {
        return $this->getFormatedDate('created_at');
    }
    public function getUpdatedAtFormated()
    {
        return $this->getFormatedDate('updated_at');
    }

    public function getFormatedValue($field)
    {
        return number_format($this->{$field}, 2, ',', '.');
    }

    public function getFormatedDate($field)
    {
        return date('d/m/Y', strtotime($this->{$field}));
    }

}
