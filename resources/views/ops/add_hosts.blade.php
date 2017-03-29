@extends('layouts.app')

@section('title', 'Add Host')

@section('content')
                Group:{{$group}}             
                <p></p>
        <form action="{{$postUrl}}" method="POST">
        {{$csrf_field}}
        
                <table class="datalist">
                    <th>Hosts List</th>
                    @foreach ($lists as $list)
                        <tr>
                            <td><input type="checkbox" value={{$list->id}} name="cb[]" />{{$list->name}}</td>                     
                        </tr>
                    @endforeach    
                </table>    
                <p></p> 
             <input type="submit" value="submit"/>
        </form>                                          
@endsection