@extends('layouts.app')

@section('title', 'Backup')

@section('content')
        <form action="{{$postUrl}}" method="POST">
        {{$csrf_field}}
                    Backup File:</br>
                    (/path/file)</br>
                    <input type="text" name="file" value="/var/www/html/"/>
                    <input type="submit" value="submit"/>
        </form>
        <p></p>
        
@endsection