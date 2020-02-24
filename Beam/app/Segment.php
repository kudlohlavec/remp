<?php

namespace App;

use App\Model\TableName;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Segment extends Model
{
    use TableName, Searchable;

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $attributes = [
        'active' => false,
    ];

    protected $fillable = [
        'name',
        'code',
        'active',
        'segment_group_id'
    ];

    /**
     * Index only id, name and code
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code
        ];
    }

    public function rules()
    {
        return $this->hasMany(SegmentRule::class);
    }

    public function users()
    {
        return $this->hasMany(SegmentUser::class);
    }

    public function browsers()
    {
        return $this->hasMany(SegmentBrowser::class);
    }

    public function segmentGroup()
    {
        return $this->belongsTo(SegmentGroup::class);
    }
}
