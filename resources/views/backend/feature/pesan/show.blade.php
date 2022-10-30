@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('customer.store'))
                @slot('method', 'POST')
                @slot('content')



                    <div id="messages"  style="overflow: scroll; height: 300px; padding: 30px;">
                        @if(!$room_id == null)
                            @foreach($room_chat as $chat)
                                @if($chat->user_id == auth()->user()->id)

                                    <div class="text-right">
                                        <small>{{strtolower(auth()->user()->name)}} - {{strtolower($chat->created_at->diffForHumans())}} </small>
                                        <br>
                                        <p>{!! $chat->pesan !!}</p>
                                    </div>
                                @else
                                    <p class="text-left">
                                        <small>{{strtolower($chat->user->name)}} - {{strtolower($chat->created_at->diffForHumans())}} </small>
                                        <br>
                                    <p>{!! $chat->pesan !!}</p>
                                    </p>
                                @endif

                            @endforeach
                        @else

                        @endif
                    </div>
                    <form action="{{ url('pesan/store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <x-forms.input type="textarea" name="pesan" id="pesan"  :isRequired="true" />
                        <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
                        <input type="text" name="chat_id" value="{{$room_id}}" hidden>
                        <button type="submit" class="btn btn-success mt-2">Kirim</button>
                    </form>






                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).on('keyup', '#name', function() {
            let val = $(this).val();
            let slugformat = val.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slugformat);
        });

        $('#messages').scrollTop($('#messages')[0].scrollHeight);
    </script>
@endpush
