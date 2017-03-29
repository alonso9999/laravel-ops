
@extends('layouts.app')

@section('title', 'Owner')

@section('content')
                <form action="{{$postUrl}}" method="POST">
                {{$csrf_field}}
                    Owner:<input type="text" name="owner" value="{{$lists->name}}"><br/><br/>
                    <input type="submit" value="submit"/>
                </form>
@endsection