<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Server
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $host
 * @property string|null $description
 * @property string|null $ssh_login_type
 * @property string|null $ssh_user
 * @property string|null $ssh_port
 * @property string|null $ssh_password
 * @property string|null $ssh_private_key
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Company $company
 */
class Server extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'name',
        'host',
        'description',
        'ssh_login_type',
        'ssh_user',
        'ssh_port',
        'ssh_password',
        'ssh_private_key',
    ];

    /**
     * Get the company that owns the server.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
