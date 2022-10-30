@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.backend.card.card-table')
                @slot('header')
                    <h4 class="card-title">{{ __('menu.pesan') }}</h4>
                    <div class="card-header-action">
                    </div>
                @endslot
                @slot('thead')
                    <tr>
                        <th>{{ __('Jumlah Pesan') }}</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($user as $data)

                                    @if($data->id == auth()->user()->id)

                                    @else
                                        <tr>
                                                <td><a href="{{route('customer.show', $data->id)}}">{{ $data->name }} ({{$data->chatReplay->count()}})</a></td>
                                        </tr>
                                    @endif
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
