
@extends('layouts.app')

@section('title', 'Show Server List')

@section('content')
        <form action="{{$postUrl}}" method="POST">
        {{$csrf_field}}
                    Search:<input type="text" name="hosts"/>
                    <input type="submit" value="submit"/>
        </form>
        <p></p>
        <table class="datalist">
                    <th>Host</th>
					<th>Ip</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Version</th>
                    <th>Command</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->name}}</td>
							<td>{{$list->ip}}</td>
                            <td>{{$list->type}}</td>
                            <td>{{$list->owner}}</td>
                            <td>{{$list->ver}}</td>
                            <td><a href="post/{{$list->id}}/edit"><button>Edit</button></a> <a href="post/destroy/{{$list->id}}"><button>Delete</button></a></td>
                        </tr>
                    @endforeach     
        </table>
{{ $lists->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$createUrl}}">Create</a></td>
        <td><a href="{{$gettypeUrl}}">Show Type</a></td>    
        <td><a href="{{$getownerUrl}}">Show Owner</a></td>      
        </tr>
        </table>

@endsection
