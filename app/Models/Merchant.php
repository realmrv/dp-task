<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $external_id
 * @property string|null $external_key
 * @property int $user_id
 * @property int $gateway_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Gateway|null $gateway
 * @method static \Database\Factories\MerchantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereExternalKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUserId($value)
 * @mixin \Eloquent
 */
class Merchant extends Model
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function gateway()
    {
        return $this->hasOne(Gateway::class);
    }
}
