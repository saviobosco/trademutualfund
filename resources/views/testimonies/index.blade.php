@extends('layouts.app')

@section('title', 'Testimonies')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        {!! Html::link("testimonies/create",'New Testimony',['class' => 'pull-right'])  !!}
                        <h4 class="panel-title"> Testimonies </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> investment </th>
                                <th> User </th>
                                <th> Testimony </th>
                                <th> publish </th>
                                <th> default </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $testimonies as $testimony)
                                <tr>
                                    <td> {{ $testimony->id }} </td>
                                    <td> {{ $testimony->Investment_id }} </td>
                                    <td> {{ $testimony->user->name }} </td>
                                    <td> {{ $testimony->testimony }} </td>
                                    <td> {!! ($testimony->published) ? '<span class="label label-success">Yes</span>' : '<span class="label label-default"> No </span>' !!} </td>
                                    <td> {!! ($testimony->default) ? '<span class="label label-success">Yes</span>' : '<span class="label label-default"> No </span>' !!} </td>
                                    <td>
                                        <a href="{{ url('/testimonies/edit/'.$testimony->id) }}" class="btn btn-sm btn-primary"> Edit </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $testimonies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
