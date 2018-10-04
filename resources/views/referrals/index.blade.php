@extends('layouts.app')

@section('title', 'Investments')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Referrals </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        $traverse = function ($referrals, $prefix = '-') use (&$traverse) {
                            foreach ($referrals as $category) {
                                echo PHP_EOL.$prefix.' '.$category->name . "<br>";

                                $traverse($category->children, $prefix.'-');
                            }
                        };
                        $traverse($referrals);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
