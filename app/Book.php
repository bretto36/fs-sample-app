<?php

namespace App;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Book extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array $guarded
     */
    protected $guarded = [];
    
    /**
     * Add a filter to search by status
     *
     * @param Builder $query
     * @param string $status
     * @return Builder
     */
    public function scopeFilterByStatus(Builder $query, string $status)
    {
        $query->where('status', $status);
        
        return $query;
    }
    
    /**
     * Format the status string to be title case without underscores.
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        return BookStatus::getDescription($this->status);
    }
}
