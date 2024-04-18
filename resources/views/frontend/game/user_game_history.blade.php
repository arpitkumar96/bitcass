{{-- <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Period</th>
                <th>Number</th>
                <th>Big Small</th>
                <th>Color</th>
                <th>Type</th>
                <th>Data</th>
                <th>Win/Lose</th>
                <th>Amount</th>
                <th>Win Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($game_participations as $game_participation)
                <tr>
                    <td>{{ $game_participation->startGame->start_game_id }}</td>
                    <td>
                        @if ($game_participation->startGame->is_running == '0')
                            <div class="{{ $game_participation->startGame->winning_color }}-number-clr">
                                {{ $game_participation->startGame->winning_number }}</div>
                        @endif
                    </td>
                    <td>
                        @if ($game_participation->startGame->is_running == '0')
                            {{ ucwords($game_participation->startGame->winning_size) }}
                        @endif
                    </td>
                    <td>
                        @if ($game_participation->startGame->is_running == '0')
                            @if ($game_participation->startGame->winning_number == 0 || $game_participation->startGame->winning_number == 5)
                                <div class="{{ explode('-', $game_participation->startGame->winning_color)[0] }}-boll">
                                </div>
                                <div class="{{ explode('-', $game_participation->startGame->winning_color)[1] }}-boll">
                                </div>
                            @else
                                <div class="{{ $game_participation->startGame->winning_color }}-boll"></div>
                            @endif
                        @endif
                    </td>
                    <td>{{ ucwords($game_participation->type) }}</td>
                    <td>{{ $game_participation->data }}</td>
                    <td>
                        @if ($game_participation->startGame->is_running == '0')
                            @if ($game_participation->is_win == '1')
                                Win
                            @else
                                Lose
                            @endif
                        @endif
                    </td>
                    <td>{{ $game_participation->final_amount }}</td>
                    <td>{{ $game_participation->win_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
<div class="col-12 mt-3">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach ($game_participations as $key_gp=>$game_participation)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading{{$key_gp+1}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{$key_gp+1}}" aria-expanded="false" aria-controls="flush-collapse{{$key_gp+1}}">
                        <div class="MyGameRecordList__C-item">
                            <div class="MyGameRecordList__C-item-l MyGameRecordList__C-item-l-1">{{ $game_participation->startGame->winning_number }}
                            </div>
                            <div class="MyGameRecordList__C-item-m">
                                <div class="MyGameRecordList__C-item-m-top">{{ $game_participation->startGame->start_game_id }}</div>
                                <div class="MyGameRecordList__C-item-m-bottom">{{$game_participation->created_at}}
                                </div>
                            </div>
                            <div class="MyGameRecordList__C-item-r">
                                <div class="">
                                    @if ($game_participation->startGame->is_running == '0')
                                        @if ($game_participation->is_win == '1')
                                        <div class="bg-success text-white">Win</div>
                                        @else
                                        <div class="bg-danger text-white">Lose</div>
                                        @endif
                                    @endif
                                </div>
                                @if ($game_participation->startGame->is_running == '0')
                                    @if ($game_participation->is_win == '1')
                                    <span class="text-success"> +{{$game_participation->win_amount}}
                                    </span>
                                    @else
                                    <span class="text-danger"> -{{ $game_participation->final_amount }}
                                    </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{$key_gp+1}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$key_gp+1}}"  data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="MyGameRecordList__C-detail">
                            <div class="MyGameRecordList__C-detail-text">Details</div>
                            {{-- <div class="MyGameRecordList__C-detail-line">Order number <div>{{ $game_participation->startGame->start_game_id }} <img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAhFBMVEUAAABRUVFQUFBRUVFRUVFRUVFRUVFRUVFQUFBRUVFQUFBRUVFQUFBQUFBRUVFRUVFSUlJSUlJRUVFQUFBSUlJRUVFRUVFRUVFRUVFRUVFRUVFQUFBRUVFRUVFRUVFRUVFQUFBRUVFRUVFRUVFQUFBQUFBQUFBSUlJYWFhJSUlQUFBRUVGJ3MxyAAAAK3RSTlMAv0B6VerZrqiblYmCaGJIOiQdFg/79vDl39TKxbq0oY9zblxONC4pCQTPqkRvegAAAWZJREFUeNrtz0duw0AQAEGSzjnnnIP+/z8ffJOBgRfgiCts9Qca1UmSNGZDP0FDN37DbIJAQH4DAQGJAwEBiQMBAYlbTsjQLWcgtQVSWyC1BVJbILUFUlsgtdUQZJiyMSGzKRsTclbwBQEpgJwXfEFACiAXBV8QkALIWsEXBKRFyGXBF2QKSD/k1WdCruYhXV4gTUHWQUBAQsg1CEgO5BukMsgNCEgO5BYEJAfSg4CAhJA7EJAcyD0ISA5kAwQEJIRsgoCAhJAHEJAcyBYICEgI2QYBAQkhjyAgOZAdEBCQELILAgISQlZAQEDagDyBgORAnkFAciB7ICAgIWQfBAQkhLyAgORAVkEWC+nnWlbI30Bqh7yCgORADkBAQMIGEBCQNiCHICAgYW8gIDmQdxCQHMgHCEgO5AgEBCTsGKRySGog/+ik4AsC0iLktOALAtIi5LPgCwJS0FfBFwSkpH7COkmSMvoBUQl8xsUGEfcAAAAASUVORK5CYII=">
                                </div>
                            </div> --}}
                            <div class="MyGameRecordList__C-detail-line">Period <div>{{ $game_participation->startGame->start_game_id }}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Purchase amount <div>₹{{ $game_participation-> amount }}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Quantity <div>{{ $game_participation->quantity }}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Amount after tax <div class="text-danger">₹{{ $game_participation->final_amount }}
                                </div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Tax <div>₹{{ $game_participation->handling_fee }}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Result <div>
                                    <div class="MyGameRecordList__C-inlineB">{{ $game_participation->startGame->winning_number }}</div>
                                    <div class="MyGameRecordList__C-inlineB greenColor">{{ ucwords($game_participation->startGame->winning_color) }}</div>
                                    <!---->
                                    <div class="MyGameRecordList__C-inlineB big">{{ ucwords($game_participation->startGame->winning_size) }}</div>
                                </div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Select <div>{{ $game_participation->data }}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Status <div class="text-danger">
                                @if ($game_participation->startGame->is_running == '0')
                                    @if ($game_participation->is_win == '1')
                                        Win
                                    @else
                                        Lose
                                    @endif
                                @endif
                            </div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Win/lose <div class="text-danger">{{$game_participation->win_amount}}</div>
                            </div>
                            <div class="MyGameRecordList__C-detail-line">Order time <div>{{$game_participation->created_at}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Accordion Item #2
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                    demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body.
                    Let's imagine this being filled with some actual content.</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Accordion Item #3
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                    demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body.
                    Nothing more exciting happening here in terms of content, but just filling up the space to make
                    it look, at least at first glance, a bit more representative of how this would look in a
                    real-world application.</div>
            </div>
        </div> --}}
    </div>
</div>
{!! $game_participations->links() !!}

<script>
    $(function() {
        $('a.page-link').on('click', function(event) {
            //$('tbody').addClass('loading')
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    //window.history.pushState("", "", url);
                    //$('tbody').removeClass('loading')
                    $('#history_div').html(data.view)
                }
            });
        });
    });
</script>
