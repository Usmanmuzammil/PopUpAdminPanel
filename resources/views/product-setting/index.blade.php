@extends('layouts.master')

@section('content')
<div class="container-fluid">

    @if (session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('message') }}</strong>
        <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <form  action="{{ url("/product-setting/update-value") }}" accept-charset="UTF-8" method="POST">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- @if (session('massage'))
                        <h2>{{ session('massage') }}</h2>
                @endif --}}
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Settings</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ps as $item)


                            <tr>
                                <td>{{ $item['name'] }}</td>
                                @php
                                $check="";
                                $value="";
                                    if($item['value']==1){
                                        $check="checked";
                                    }else{
                                        $check="";
                                    }
                                @endphp
                                <td>
                                    <input type="checkbox" name="value[]" {{$check}} value="{{$item['id']}}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

    <div>
        <input class="btn btn-primary float-end" type="submit" name="submit" value="submit">
    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </form>

                    </div>
@endsection
