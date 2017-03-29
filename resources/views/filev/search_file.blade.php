
@extends('layouts.app')

@section('title', 'Search file')

@section('content')
        <label>*{{$file}}*</label>
        <table class="datalist">
                    <thead>
                    <td>File</td>
					<td>Path</td>
                    <td>Update time</td>
                    <td>Operate</td>
                    </thead>
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
        <td><a href="{{$showUrl}}">Show File List</a></td>                
        </tr>
        </table>
@endsection