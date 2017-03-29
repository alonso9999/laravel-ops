
@extends('layouts.app')

@section('title', 'Search_hosts')

@section('content')
        <label>*{{$hosts}}*</label>
        <table class="datalist">
                    <th>Host</th>
					<th>Ip</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Command</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->name}}</td>
							<td>{{$list->ip}}</td>
                            <td>{{$list->type}}</td>
                            <td>{{$list->owner}}</td>
                            <td><a href="post/{{$list->id}}/edit"><button>Edit</button></a> <a href="post/destroy/{{$list->id}}"><button>Delete</button></a></td>
                        </tr>
                    @endforeach     
        </table>
{{ $lists->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Show</a></td>    
        </tr>
        </table>
@endsection
