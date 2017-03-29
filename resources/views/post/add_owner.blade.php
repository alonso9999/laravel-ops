@extends('layouts.app')

@section('title', 'Add Owner')

@section('content')
                <form action="{{$postUrl}}" method="POST">
                {{$csrf_field}}
                    Owner:<input type="text" name="owner"><br/><br/>
                    <input type="submit" value="submit"/>
                </form>
<p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        </tr>
        </table>
@endsection