@extends('layouts.client')

@section('content-client')
<div class="container mt-4">
    <h2>Thông Báo Của Bạn</h2>
    <div class="notifications">
        @if(auth()->user()->notifications->count() > 0)
            <ul class="list-group">
                @foreach(auth()->user()->notifications as $notification)
                    <li class="list-group-item">
                        <div>
                            <p><strong>{{ $notification->data['message'] }}</strong></p>
                            <p>Mã đơn hàng: <a href="{{ url('/orders/' . $notification->data['order_id']) }}">{{ $notification->data['order_id'] }}</a></p>
                            <p><small>{{ $notification->created_at->diffForHumans() }}</small></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Bạn không có thông báo nào.</p>
        @endif
    </div>
</div>
@endsection
