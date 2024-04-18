<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">Level</th>
            @for ($i = 1; $i <= $number_of_tier; $i++)
                <th class="text-center">Tier {{$i}} (in %)</th>
            @endfor
        </tr>
        </thead>
        <tbody>
            @for ($j = 0; $j <= $number_of_level; $j++)
                <tr>
                    <td class="text-center">L {{$j}}</td>
                    @for ($i = 1; $i <= $number_of_tier; $i++)
                        <td class="text-center">
                            <input type="number" step="0.01" class="form-control" placeholder="Enter Commission (in %)..." name="tier_{{$i}}[]" @isset($final_array[$j][$i-1]) value="{{$final_array[$j][$i-1]['commission']}}" @endisset>
                        </td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</div>
