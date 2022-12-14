@extends('layouts.theme')
@section('content')
<div class="row">
    <div class="mi-card">
        <div class="mi-header"> LIST OF ADMINS </div>
        <div class="mi-body">
            <table class="mi-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php $i = 0; ?> @foreach($data as $item) <tr>
                        <td>{{ ++$i }}</td>
                        <td> {{ $item->name}} </td>
                        <td> {{ $item->email}} </td>
                        <td class="mi-action-button"><a href="{{ route('admin.edit',['id'=>$item->id]) }}"> <button class="butn warning transparent"><i class="fa fa-edit"></i></button></a><a onclick="return confirm('Are you sure to delete')" href="{{ route('admin.delete',['id'=>$item->id]) }}"> <button class="butn danger transparent"><i class="fa fa-trash"></i></button></a> </td>
                    </tr> @endforeach </tbody>
            </table>
        </div>
        <div class="mi-footer">
            <div class="float-right"> </div>
        </div>
    </div>
</div>
@endsection
