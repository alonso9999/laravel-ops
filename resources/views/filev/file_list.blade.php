
@extends('layouts.app')

@section('title', 'File List')

@section('content')
        <form action="{{$postUrl}}" method="POST">
        {{$csrf_field}}
                    Search:<input type="text" name="file"/>
                    <input type="submit" value="submit"/>
        </form>
        <p></p>
        <table class="datalist">
                    <th>File</th>
					<th>Path</th>
                    <th>Update time</th>
                    <th>Operate</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->name}}</td>
							<td>{{$list->path}}</td>
                            <td>{{$list->updated_at}}</td>
                            <td><a href="file/destroy/{{$list->id}}"><button>Delete</button></a> </td>
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
@endsection