@extends('layouts.app')
@section('content')
@php
    echo '<h2> '.$tin[0]?->TenLoai.'</h2><br><hr/>';
    $t = $tin?->slice(3);
@endphp    
    <section class="row">
        <div class="col-12 col-md-8">
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tin[0]?->id?>">
                <article>
                    <img src="{{(asset($tin[0]?->thumbnail))}}"/>
                    <h3>{{$tin[0]?->TieuDe}}</h3>
                    <p>{{$tin[0]?->TomTat}}</p>
                </article>
            </a>
        </div>
        <div class="col-12 col-md-4 phu">
            @isset($tin[1])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tin[1]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tin[1]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tin[1]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
            @isset($tin[2])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tin[2]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tin[2]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tin[2]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
        </div>
    </section>
@foreach ($t as $tin)
    <section class="my-5">
        <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tin?->id?>">
            <article>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <img src="{{asset($tin?->thumbnail)}}"/>
                    </div>
                    <div class="col-12 col-md-9">
                        <h3>{{$tin?->TieuDe}}</h3>
                        <p>{{$tin?->TomTat}}</p>
                    </div>  
                </div>
            </article>
        </a>
    </section>
@endforeach
@endsection