@extends('layouts.app')

@section('title', 'Show Server')

@section('content')
                    <h3>Host: {{$list[0]->hosts}}</h3>
                    <p>IP: {{$list[0]->ip}}</p>
                    <p>Owner: {{$list[0]->owner}}</p>
                    <p>
                    <a href="{{$editUrl}}">Edit</a>
</p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        </tr>
        </table>
@endsection