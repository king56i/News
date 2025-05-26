@extends('layouts.app')
@section('content')
@php
    echo '<h2> '.$tinmoi[0]?->TenLoai.'</h2><br><hr/>';
    $tm = $tinmoi?->slice(3);
@endphp    
    <section class="row">
        <div class="col-12 col-md-8">
            <a style="text-decoration:none" class="col-12" href="{{config('app.url')}}/tin/<?=$tinmoi[0]?->id?>">
                <article width="100%">
                    <img style="object-fit:cover" src="{{(asset($tinmoi[0]?->thumbnail))}}"/>
                    <h3>{{$tinmoi[0]?->TieuDe}}</h3>
                    <p>{{$tinmoi[0]?->TomTat}}</p>
                </article>
            </a>
        </div>
        <div class="col-12 col-md-4 phu">
            @isset($tinmoi[1])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tinmoi[1]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tinmoi[1]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tinmoi[1]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
            @isset($tinmoi[2])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tinmoi[2]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tinmoi[2]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tinmoi[2]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
        </div>
    </section>
@foreach ($tm as $tin)
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