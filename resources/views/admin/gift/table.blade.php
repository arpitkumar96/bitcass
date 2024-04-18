<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Code</th>
            <th class="text-center">Name</th>
            <th class="text-center">Image</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">End Date</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Number Of Usage</th>
            <th class="text-center">Is Active</th>
            @canany(['gift-edit', 'gift-delete'])
                <th class="text-center">Action</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
            @forelse ($gifts as $key=>$gift)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($gifts->currentPage() - 1) * $gifts->perPage() }}</td>
                    <td class="text-center"><i class="fa fa-gift"></i> {{$gift->code}}</td>
                    <td class="text-center">{{$gift->name}}</td>
                    <td class="text-center">
                        <img src="{{asset('backend/assets/image/gifts/'.$gift->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';" >
                    </td>
                    <td class="text-center"><i class="fa fa-calendar"></i> {{$gift->start_date}}</td>
                    <td class="text-center"><i class="fa fa-calendar"></i> {{$gift->end_date}}</td>
                    <td class="text-center"><i class="fa fa-rupee-sign"></i> {{$gift->amount}}</td>
                    <td class="text-center"><i class="fa fa-users"></i>
                        @if($gift->usage_limitation == 'limited')
                            {{$gift->number_of_usage}}
                        @else
                            ∞
                        @endif
                    </td>
                    <td class="text-center">
                        @if($gift->is_active == '1')
                        @can('gift-status')
                            <a href="{{route('admin.gift.show',$gift->id)}}?status=0">
                                <span class="badge badge-primary">Active</span>
                            </a>
                        @else
                            <span class="badge badge-primary">Active</span>
                        @endcan
                        @else
                            @can('gift-status')
                                <a href="{{route('admin.gift.show',$gift->id)}}?status=1">
                                    <span class="badge badge-danger">Inactive</span>
                                </a>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endcan
                        @endif
                    </td>
                    @canany(['gift-edit', 'gift-delete'])
                        <td class="text-center">
                            @can('gift-edit')
                                <x-admin.edit-button route="{{route('admin.gift.edit', $gift->id)}}" />
                            @endcan
                            @can('gift-delete')
                                <x-admin.delete-button route="{{route('admin.gift.destroy', $gift->id)}}" id="{{$gift->id}}" />
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
            <b>Showing {{ ($gifts->currentpage() - 1) * $gifts->perpage() + 1 }} to {{ ($gifts->currentpage() - 1) * $gifts->perpage() + $gifts->count() }} of {{ $gifts->total() }} gifts</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $gifts->links() !!}
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
