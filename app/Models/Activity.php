<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property int|null $contact_id
 * @property int|null $deal_id
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $scheduled_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property string $status
 * @property string|null $outcome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\Deal|null $deal
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity overdue()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereDealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity withoutTrashed()
 * @mixin \Eloquent
 */
class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_id',
        'contact_id',
        'deal_id',
        'type',
        'title',
        'description',
        'scheduled_at',
        'completed_at',
        'status',
        'outcome'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    const TYPES = [
        'call',
        'email',
        'meeting',
        'task',
        'note'
    ];

    const STATUSES = [
        'scheduled',
        'completed',
        'cancelled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isPending()
    {
        return $this->status === 'scheduled';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
                    ->where('scheduled_at', '>=', now())
                    ->orderBy('scheduled_at');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'scheduled')
                    ->where('scheduled_at', '<', now())
                    ->orderBy('scheduled_at');
    }
}
