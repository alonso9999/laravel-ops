
@extends('layouts.app')

@section('title', 'Server Type')

@section('content')
                <form action="{{$postUrl}}" method="POST">
                {{$csrf_field}}
                    Type:<input type="text" name="type" value="{{$lists->name}}"><br/><br/>
                    <input type="submit" value="submit"/>
                </form>
@endsection