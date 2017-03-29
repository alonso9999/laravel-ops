@extends('layouts.app')

@section('title', 'Upload File')

@section('content')
                <form action="{{$postUrl}}" method="POST" enctype="multipart/form-data" >
                {{$csrf_field}}
                    File:<input type="file" name="file"/><br/><br/>
                    <input type="submit" value="submit"/>
                </form>
<p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Back</a></td>
        </tr>
        </table>
@endsection