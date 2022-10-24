<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Payment.
 *
 * @property int                             $id
 * @property string                          $status
 * @property int                             $amount
 * @property int                             $amount_paid
 * @property int                             $merchant_id
 * @property string                          $external_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereAmount($value)
 * @method static Builder|Payment whereAmountPaid($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereExternalId($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment whereMerchantId($value)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 *
 * @mixin Eloquent
 *
 * @property Merchant $merchant
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'amount',
        'amount_paid',
        'external_id',
        'merchant_id',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
