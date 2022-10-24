<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Gateway.
 *
 * @property int id
 * @property string $name
 * @property string $code
 * @property int|null $amount_limit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Gateway newModelQuery()
 * @method static Builder|Gateway newQuery()
 * @method static Builder|Gateway query()
 * @method static Builder|Gateway whereCode($value)
 * @method static Builder|Gateway whereCreatedAt($value)
 * @method static Builder|Gateway whereId($value)
 * @method static Builder|Gateway whereName($value)
 * @method static Builder|Gateway whereUpdatedAt($value)
 * @method static Builder|Gateway whereAmountLimit($value)
 *
 * @mixin Eloquent
 *
 * @property Merchant[]|null $merchants
 * @property int|null                    $merchants_count
 */
class Gateway extends Model
{
    use HasFactory;

    public function merchants(): HasMany
    {
        return $this->hasMany(Merchant::class);
    }
}
