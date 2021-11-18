@extends('layout')


@php
    $id = $group->id
@endphp


@section('content')
    <x-chat.header :user="$user" :group="$group" :groups="$groups" :otherGroups="$otherGroups"/>
   
    <x-chat.body :chats="$group->chats" :user="$user" :newUser="$welcome"/>
    
    <x-chat.footer :group="$group"/>

    <script>
        let id = "<?php echo $id; ?>";
        let userID = "<?php echo $user->id; ?>";
        let username = "<?php echo $user->name; ?>";
        let welcome = "<?php echo $welcome; ?>";
    </script>
@endsection