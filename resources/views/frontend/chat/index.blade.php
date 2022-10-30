@extends('layouts.frontend.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Kirim Pesan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ask">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <div class="text">
                    <h6 class="my-3 text-center">Tanya penjual</h6>
                </div>
               <div class="link">
                   @if(!$room_id == null)
                       <a href="{{url('pesan/distroy', $room_id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                   @endif
               </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                 <div class="chat" id="messages">
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
                      <textarea id="summernote" name="pesan" required></textarea>
                      <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
                      <input type="text" name="chat_id" value="{{$room_id}}" hidden>
                      <button type="submit" class="btn btn-success mt-2">Kirim</button>
                  </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    {{--summernote--}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 70
        });

        $('#messages').scrollTop($('#messages')[0].scrollHeight);

    </script>
@endpush
