
@extends('layouts.app')

@section('title', 'Data List')

@section('content')
<label>Data List</label>
        <table class="datalist">
                    <th>User</th>
					<th>Email</th>
                    <th>File</th>
                    <th>Results</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->username}}</td>
                            <td>{{$list->email}}</td>  
                            <td>{{$list->file}}</td>
                            <td>{{$list->results}}</td>              
                        </tr>
                    @endforeach
        </table>
{{ $lists->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$uploadUrl}}">Upload File</a></td>        
        
        </tr>
        </table>
        <p></p>       
<label>Queue List</label>
        <table class="datalist">
                    <th>Id</th>
					<th>Queue</th>
                    <th>Command</th>
                    <th>Attempts</th>
                    @foreach ($jobs as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->queue}}</td>  
                            <td>{{$list->payload}}</td>
                            <td>{{$list->attempts}}</td>              
                        </tr>
                    @endforeach
        </table>
@endsection