@section('session-scripts')
    @if (\Session::has('success'))
        <script>
            Notification.Success('{!! \Session::get('success') !!}');
        </script>
    @endif
    @if (\Session::has('error'))
        <script>
            Notification.Error('{!! \Session::get('error') !!}');
        </script>
    @endif
@endsection
