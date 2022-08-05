<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'content'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['author'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d.m.Y в H:i:s',
        'updated_at' => 'datetime:d.m.Y в H:i:s',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the comment's author.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function author(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->user) {
                    return $this->user->name;
                }

                return 'Account deleted';
            },
        );
    }

    /**
     * Get the comment's created time.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d.m.Y в H:i:s', strtotime($value)),
        );
    }

    /**
     * Get the comment's updated time.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d.m.Y в H:i:s', strtotime($value)),
        );
    }
}
