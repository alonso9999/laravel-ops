@extends('layouts.app')

@section('title', 'Add Type')

@section('content')
                <form action="{{$postUrl}}" method="POST">
                {{$csrf_field}}
                    Type:<input type="text" name="type"><br/><br/>
                    <input type="submit" value="submit"/>
                </form>
<p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        </tr>
        </table>
@endsection