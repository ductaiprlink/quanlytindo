<?PHP

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    protected $table = 'users';

    protected $fillable = [
        "name",
        "email",
        "password",
        "is_a",
        "status"
    ];

    protected $guarded = ['is_a'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 1 user chỉ có 1 password security
    public function passwordSecurity()
    {
        return $this->hasOne('App\PasswordSecurity');
    }
}
