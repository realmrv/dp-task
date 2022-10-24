<?php

namespace App\Models;

use Database\Factories\MerchantFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Merchant.
 *
 * @property int $id
 * @property string $external_id
 * @property string|null $external_key
 * @property int $user_id
 * @property int $gateway_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Gateway|null $gateway
 *
 * @method static MerchantFactory factory(...$parameters)
 * @method static Builder|Merchant newModelQuery()
 * @method static Builder|Merchant newQuery()
 * @method static Builder|Merchant query()
 * @method static Builder|Merchant whereCreatedAt($value)
 * @method static Builder|Merchant whereExternalId($value)
 * @method static Builder|Merchant whereExternalKey($value)
 * @method static Builder|Merchant whereGatewayId($value)
 * @method static Builder|Merchant whereId($value)
 * @method static Builder|Merchant whereUpdatedAt($value)
 * @method static Builder|Merchant whereUserId($value)
 *
 * @mixin Eloquent
 *
 * @property Collection|Payment[] $payments
 * @property int|null $payments_count
 */
class Merchant extends Model
{
    use HasFactory;

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
