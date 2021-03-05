<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StuffProperty extends Model
{
    protected $table = 'stuff_properties';

    protected $fillable = [
        'stuff_id', 'property_id', 'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
