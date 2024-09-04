<?php
namespace TijmenWierenga\LaravelChargebee;


use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = ['addon_id', 'quantity', 'name'];

    public function __construct(array $attributes = [])
    {
        $this->table = config('chargebee.addons_table_name');

        parent::__construct($attributes);
    }
}