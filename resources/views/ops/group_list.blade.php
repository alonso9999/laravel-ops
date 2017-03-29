
@extends('layouts.app')

@section('title', 'Group List')

@section('content')
<label>Group List</label>
        <table class="datalist">
                    <th>Id</th>
					<th>Name</th>
                    <th>Command</th>
                    <th>OPS</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td><a href="ops/show/{{$list->id}}"><button>Show</button></a><a href="ops/delete/{{$list->id}}"><button>Delete</button></a></td>     
                            <td><a href="ops/backup/{{$list->id}}"><button>backup</button></a>
                            <a href="ops/release/{{$list->id}}"><button>Release</button>
                            </a><a href="ops/run/free/{{$list->id}}"><button>Free -m</button></a></td>                    
                        </tr>
                    @endforeach
        </table>
{{ $lists->links() }}
        <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$addgroupUrl}}">Add Group</a></td>        
        
        </tr>
        </table>
@endsection