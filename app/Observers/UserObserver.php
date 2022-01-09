<?php

namespace App\Observers;

use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
  public function created(User $user)
  {
    Mail::to($user)->send(new UserRegistered($user));
  }
}
