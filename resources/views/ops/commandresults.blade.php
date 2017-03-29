@extends('layouts.app')

@section('title', 'Edit Group')

@section('content')
                <table>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list}}</td>                      
                        </tr>
                    @endforeach    
                </table>    
                <p></p>
        <table class="datalist">
        <tr>
        <td><a href="{{$showUrl}}">Show Group</a></td>           
        </tr>
        </table>                
                                       
@endsection