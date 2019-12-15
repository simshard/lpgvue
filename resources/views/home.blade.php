@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <card v-bind:carddata="{cardheader: 'https://google.com', cardtitle: 'Google', cardfooter: '@google' }" class="mb-5">
            </card>

            <card v-bind:carddata="{cardheader: 'https://vuejs.org', cardtitle: 'Vue', cardfooter: '@vuejs' }" class="mb-5">
            </card>

            <card v-bind:carddata="{cardheader: 'https://laravel.com', cardtitle: 'Laravel', cardfooter: '@laravel' }" class="mb-5">
            </card>
        </div>
    </div>
</div>
@endsection
