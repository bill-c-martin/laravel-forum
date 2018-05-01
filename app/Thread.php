<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    /**
     * Replies to this thread
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * User who created this thread
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The channel that the thread belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Returns the thread creator's name
     *
     * @return string
     */
    public function creatorName(): string
    {
        return $this->creator->name;
    }

    /**
     * Adds a reply to this thread
     *
     * @param array $reply ['body'=>, 'user_id'=>]
     */
    public function addReply(array $reply)
    {
        $this->replies()->create($reply);
    }
}
