<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'user_id',
        'contact_id',
        'title',
        'amount',
        'status',
        'expected_closing_date',
        'probability',
        'description',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'probability' => 'integer',
        'expected_closing_date' => 'date'
    ];

    const STATUSES = [
        'prospecting',
        'qualification',
        'needs_analysis',
        'proposal',
        'negotiation',
        'closed_won',
        'closed_lost'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function isWon()
    {
        return $this->status === 'closed_won';
    }

    public function isLost()
    {
        return $this->status === 'closed_lost';
    }

    public function isClosed()
    {
        return $this->isWon() || $this->isLost();
    }
}
