<div class="bd-example main_background">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group show">
            <button class="btn btn-lg dropdown-toggle text-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                @if(session('filter') == '') Sort By @else{{ucfirst( session('filter'))}} @endif
            </button>
            <div class="dropdown-menu drop_filter" style="background-color: black;" x-placement="top-start" >
                <a class="dropdown-item " href="{{route('battles', ['filter' => 'latest'])}}">Latest</a>
                <a class="dropdown-item " href="{{route('battles', ['filter' => 'upcoming'])}}">Upcoming</a>
            </div>
        </div><!-- /btn-group -->
    </div><!-- /btn-toolbar -->
</div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#filter").on('change', function () {
        let filter = this.value;
        $.ajax({
            type: 'POST',
            url: '{{route('filter')}}',
            data: {filter: filter},
            success: function (response) {
                window.location.reload();
            },
            error: function (error) {
                console.log(error)
            }
        });

    });
</script>
