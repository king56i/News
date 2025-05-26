@extends('layouts.app')
@section('content')
@php
    echo '<h2> '.$tintrongloai[0]?->TenLoai.'</h2><br><hr/>';
    $ttl = $tintrongloai?->slice(3);
@endphp    
    <section class="row">
        <div class="col-12 col-md-8">
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tintrongloai[0]?->id?>">
                <article>
                    <img src="{{(asset($tintrongloai[0]?->thumbnail))}}"/>
                    <h3>{{$tintrongloai[0]?->TieuDe}}</h3>
                    <p>{{$tintrongloai[0]?->TomTat}}</p>
                </article>
            </a>
        </div>
        <div class="col-12 col-md-4 phu">
            @isset($tintrongloai[1])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tintrongloai[1]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tintrongloai[1]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tintrongloai[1]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
            @isset($tintrongloai[2])
            <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$tintrongloai[2]?->id?>">

                <article class="row my-2">
                    <img src="{{asset($tintrongloai[2]?->thumbnail)}}" class="col-12 col-md-6"/>
                    <h6 class="col-12" >{{$tintrongloai[2]?->TieuDe}}</h6>
                </article>
            </a>
            @endisset
        </div>
    </section>
@foreach ($ttl as $tin)
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