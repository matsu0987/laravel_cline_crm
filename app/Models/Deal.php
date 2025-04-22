<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property int|null $contact_id
 * @property string $title
 * @property numeric $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $expected_closing_date
 * @property int $probability
 * @property string|null $description
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereExpectedClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal withoutTrashed()
 * @mixin \Eloquent
 */
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
