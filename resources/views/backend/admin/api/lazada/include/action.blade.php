
    @if($item['status'] == 'Active')
        {{--['item_id' => 'hihi','status'=>'inactive']--}}
        <a href="{{ route('lazada.status',['item_id'=>$item['item_id'],'status' => 'inactive']) }}" class="btn btn-warning">InActive</a>
        <a href="{{ route('lazada.remove',['item_id'=>$item['item_id']]) }}" class="btn btn-danger">Delete</a>
    @elseif($item['status'] == 'InActive')
        <a href="{{ route('lazada.status',['item_id'=>$item['item_id'],'status' => 'active']) }}" class="btn btn-success">Active</a>
        <a href="{{ route('lazada.remove',['item_id'=>$item['item_id']]) }}" class="btn btn-danger">Delete</a>
{{--    @else--}}
{{--        <a href="{{ route('lazada.restore',['item_id'=>$item['item_id']]) }}" class="btn btn-success">Restore</a>--}}
    @endif
