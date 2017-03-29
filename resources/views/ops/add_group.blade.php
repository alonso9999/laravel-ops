@extends('layouts.app')

@section('title', 'Add Group')

@section('content')
        <form action="{{$postUrl}}" method="post">
        {{$csrf_field}}
        Group Name:<input type="text" name="name"><br/><br/>                
        <input type="submit" value="submit"/>
        </form>                                      
        <p></p>
@endsection