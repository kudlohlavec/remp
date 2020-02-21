<?php

namespace App;

use App\Model\TableName;
use App\Traits\SearchableAttributes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Segment extends Model
{
    use TableName, Searchable, SearchableAttributes;

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

    public $searchable = [
        'name',
        'code'
    ];

    /**
     * Index only searchable data
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->getSearchableAttributes($this->searchable, $this->getKeyName(), $this->getAttributes());
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
