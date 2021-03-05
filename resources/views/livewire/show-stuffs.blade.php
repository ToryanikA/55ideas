<div>
    <div class="row mb-5">
        @foreach($filterData as $name => $item)
            <div class="col-md-3 mt-5">
                <p>{{$name}}</p>
                <select class="mt-3" wire:model="filter.{{$name}}" multiple>
                    @foreach($item as $v)
                        <option>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead>
        <tr>
            <td>ID</td>
            <td>NAME</td>
            <td>PROPERTIES</td>
            <td>PRICE</td>
            <td>COUNTS</td>
        </tr>
        </thead>
        <tbody>
        @if($stuffs->count() == 0)
            <tr>
                <td colspan="4" class="text-center">Not found</td>
            </tr>
        @endif
        @foreach ($stuffs as $stuff)
            <tr>
                <td>{{$stuff->id}}</td>
                <td>{{$stuff->name}}</td>
                <td>
                    @foreach($stuff->properties as $property)
                        <div>
                            {{$property->value}} ({{$property->property->name}})
                        </div>
                    @endforeach
                </td>
                <td>{{$stuff->price}}</td>
                <td>{{$stuff->counts}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $stuffs->links() }}
    </div>
</div>
