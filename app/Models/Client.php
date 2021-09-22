<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $surname
 * @property int $is_telegram
 * @property int $telegram_id
 * @property int $telegram_id_chat
 * @property int $manager
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUsername($value)
 * @property string|null $external-id
 * @property string|null $clients_id
 * @property string|null $chat_id
 * @property string|null $phone_number
 * @property string|null $email
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhoneNumber($value)
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'email',
        'phone_number',
        'username',
        'username',
        'first_name',
        'last_name',
        'clients_id',
        'chat_id',
        'image_path',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
