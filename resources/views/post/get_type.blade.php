
@extends('layouts.app')

@section('title', 'Server Type')

@section('content')
<label>Server Type</label>
        <table class="datalist">
                    <th>Id</th>
					<th>Name</th>
                    <th>Command</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td><a href="edittype/{{$list->id}}"><button>Edit</button></a></td>                            
                        </tr>
                    @endforeach
 
        </table>
{{ $lists->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        <td><a href="addtype">Add Type</a></td>
        </tr>
        </table>
@endsection