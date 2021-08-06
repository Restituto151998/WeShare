<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {

        $imagePath = ($this->image)? $this->image: 'profile/0kbhC6dMIoxcxo59YjB6oRT1aGjf4BoW0hzI1Uw1.png';
        return '/storage/' .$imagePath;
    }
    public function coverPhoto()
    {

        $imagePath1 = ($this->bg_image)? $this->bg_image: 'profile/0kbhC6dMIoxcxo59YjB6oRT1aGjf4BoW0hzI1Uw1.png';
        return '/storage/' .$imagePath1;
    }

    public function followers()
    {
      return  $this->belongsToMany(User::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);   
    }

    public function reacts()
    {
        return $this->hasMany(React::class);
    }
}
