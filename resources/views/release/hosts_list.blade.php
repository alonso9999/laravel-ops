
@extends('layouts.app')

@section('title', 'Host Ver List')

@section('content')
        <table class="datalist">
        <tr><th>Host Id</th><th>Host name</th><th>Version</th><th>Update Time</th></tr>
        @foreach($list as $value)
        <tr>
        @foreach($value as $i)
        <td>{{$i}}</td>            
        @endforeach
        </tr>
        @endforeach        
        </table>
{{ $list->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$backup}}">Backup</a></td>        
        
        </tr>
        </table>
@endsection