@section('session-scripts')
    <script>
        @if (\Session::has('success'))
            Notification.Success('{!! \Session::get('success') !!}');
        @endif
        @if (\Session::has('error'))
            Notification.Error('{!! \Session::get('error') !!}');
        @endif
    </script>
@endsection
