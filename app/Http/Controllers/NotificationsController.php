<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;


class NotificationsController extends Controller
{


    public function show(){
        if(Auth::check()){
        $user=Auth::user();
        $userNotifications=$user->notifications;
        $unseenUserNotifications=$userNotifications->where('is_seen','=',0);
        foreach($unseenUserNotifications as $userNotification){
            $userNotification->is_seen= 1;
            $userNotification->save();
        }
        if(Auth::user()->hasRole('admin')){
            return view('admin.notifications.show',compact('userNotifications'));
        }
        return view('notifications.show',compact('userNotifications'));
    }
    return view('notfound');
    }
    public function updateAllRead(){
        $user=Auth::user();
        $userNotifications=$user->notifications->where('is_seen','=',0);
        foreach($userNotifications as $userNotification){
            $userNotification->is_seen= 1;
            $userNotification->save();
        }
        return response()->json(['res' => 'success']);
    }

    public function edit($id){
        $notification=Notification::find($id);
        if($notification->is_seen==0){
        $notification->is_seen=1;
        $notification->save();
        return ['res' => 'unseen'];
        }
        else
        return ['res' => 'seen'];
    }






}
