@extends('layouts.app')

@section('title', 'Edit Group')

@section('content')
                Group:{{$lists->name}}
                <table class="datalist">
                <th>Hosts for Group</th>
                <th>Command</th>
                    @foreach ($hosts as $list)
                        <tr>
                            <td>{{$list->name}}</td>   
                            <td><a href="deletehosts/{{$list->pivot->group_id}}/{{$list->pivot->host_id}}"><button>Delete</button></a></td>                      
                        </tr>
                    @endforeach    
                </table>     
                <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$addhostUrl}}">Add Hosts to Group</a></td>
        <td><a href="{{$showUrl}}">Show Group</a></td>           
        </tr>
        </table>                
                                       
@endsection