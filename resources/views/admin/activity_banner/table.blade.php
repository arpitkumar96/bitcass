<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Image</th>
            <th class="text-center">Name</th>
            <th class="text-center">Url</th>
            @canany(['activity_banner-edit', 'activity_banner-delete'])
                <th class="text-center">Action</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
            @forelse ($activity_banners as $key=>$activity_banner)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($activity_banners->currentPage() - 1) * $activity_banners->perPage() }}</td>
                    <td class="text-center">
                        <img src="{{asset('backend/assets/image/activity_banners/'.$activity_banner->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';" >
                    </td>
                    <td class="text-center">{{$activity_banner->name}}</td>
                    <td class="text-center">
                        <a href="{{$activity_banner->url??'#'}}">
                            {{$activity_banner->url}}
                        </a>
                    </td>
                    @canany(['activity_banner-edit', 'activity_banner-delete'])
                        <td class="text-center">
                            @can('activity_banner-edit')
                                <x-admin.edit-button route="{{route('admin.activity-banner.edit', $activity_banner->id)}}" />
                            @endcan
                            @can('activity_banner-delete')
                                <x-admin.delete-button route="{{route('admin.activity-banner.destroy', $activity_banner->id)}}" id="{{$activity_banner->id}}" />
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @empty
                <x-admin.empty-table />
            @endforelse
        </tbody>
    </table>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <p>
            <b>Showing {{ ($activity_banners->currentpage() - 1) * $activity_banners->perpage() + 1 }} to {{ ($activity_banners->currentpage() - 1) * $activity_banners->perpage() + $activity_banners->count() }} of {{ $activity_banners->total() }} activity_banners</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $activity_banners->links() !!}
        </div>
    </div>
</div>

<script>

    $(function() {
        $('a.page-link').on('click', function(event) {
            $('tbody').addClass('loading')
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    window.history.pushState("", "", url);
                    $('tbody').removeClass('loading');
                    $('#table_div').html(data);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    });

</script>
