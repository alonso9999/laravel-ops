@extends('layouts.app')

@section('title', 'Create Server')

@section('content')
                <form action="{{$postUrl}}" method="POST">
                {{$csrf_field}}
                    Host:<input type="text" name="hosts"><br/><br/>
                    IP:<input type="text" name="ip"><br/><br/>
                    <label>Type:</label>
                    <select name="type">
                    @foreach ($type_list as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                    @endforeach 
                    </select><br/><br/>               
                    <label>Owner:</label>
                    <select name="owner">
                    @foreach ($owner_list as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                    @endforeach
                    </select><br/><br/>                      
                    <input type="submit" value="submit"/>
                </form>
<p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        </tr>
        </table>
@endsection