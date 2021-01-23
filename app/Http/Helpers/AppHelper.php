<?php

namespace App\Http\Helper;

class AppHelper
{

    //Response Messages
    const DataAdded = 'has been added Successfully';
    const DataUpdated = 'has been updated Successfully';
    const DataDeleted = 'has been deleted Successfully';
    const UserProfile = 'You need to create profile first';
    const UserBanned = 'has been banned Successfully';
    const UserUnbanned = 'has been unbanned Successfully';

    //User role id
    const OwnerRoleId = 1;
    const SeekerRoleId = 2;

    //functions

    public static function hasProfile($model)
    {
        if (\auth()->user()->$model == null) {
            return redirect($model . '/profile/' . auth()->user()->name);
        } else {
            return null;
        }
    }

    public function sayhello($name)
    {
        return $name;
    }


}


