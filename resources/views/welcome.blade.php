@extends('layouts.app')

@section('content')
    <div class="form-group mt-10">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pasien') }}</label>
        <div class="col-md-6">
            <input type="text" id='pasien' class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Puskesmas') }}</label>
        <div class="col-md-6">
            <input type="text" id='puskesmas' class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan') }}</label>
        <div class="col-md-6">
            <input type="text" id='kecamatan' class="form-control">
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#pasien" ).autocomplete({
                source: function( request, response ) {
                    console.log(request.term)
                $.ajax({
                    url:"{{route('pasien')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        cari: request.term
                    },
                    success: function( data ) {
                    response( data );
                    }
                });
                },
                select: function (event, ui) {
                $('#pasien').val(ui.item.label);
                $('#puskesmas').val(ui.item.faskes);
                $('#kecamatan').val(ui.item.kecamatan);
                return false;
                }
            });
        });
  </script>
@endpush