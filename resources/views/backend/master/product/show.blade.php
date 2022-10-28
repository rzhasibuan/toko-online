@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['product']->name }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('master.product.edit',$data['product']->id) }}" class="btn btn-success">{{ __('button.edit') }}</a>
                        <a href="{{ route('master.product.index') }}" class="btn btn-primary">{{ __('button.back') }}</a>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>{{ __('field.product_name') }}</td>
                                <td>: {{ $data['product']->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('field.category_name') }}</td>
                                <td>: {{ $data['product']->category->name }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.price') }}</td>
                                <td>: {{ rupiah($data['product']->price) }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.jenis_bahan') }}</td>
                                <td>: {{ ($data['product']->jenis_bahan) }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.detail_bahan') }} :</td>
                                <td>{!! ($data['product']->detail_bahan) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.spesifikasi_bahan') }} :</td>
                                <td> {!!  ($data['product']->spesifikasi_bahan) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.bonus') }}</td>
                                <td>: {{ ($data['product']->bonus) }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('field.stok') }}</td>
                                <td>: {{ ($data['product']->stok) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('field.weight') }}</td>
                                <td>: {{ $data['product']->weight }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('field.description') }}</td>
                                <td>: {!! $data['product']->description !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ $data['product']->thumbnails_path }}" alt="" class="w-100">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
