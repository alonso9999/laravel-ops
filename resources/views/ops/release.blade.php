@extends('layouts.app')

@section('title', 'Release')

@section('content')
        <form action="{{$postUrl}}" method="POST">
        {{$csrf_field}}                    
                    <label>Select File:</label>
                    <select name="file">
                    @foreach ($lists as $i)
                        <option value="{{$i->name}}">{{$i->name}}</option>
                    @endforeach 
                    </select><br/><br/>  
                    Release Path:<input type="text" name="path" value="/var/www/html/"/><br/><br/>                      
                    <input type="submit" value="submit"/>
        </form>
        <p></p>        
@endsection