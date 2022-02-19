@if($item['status']=='Active')
    <span class="badge bg-success">Active</span>
@elseif($item['status'] == 'InActive')
    <span class="badge bg-warning text-dark">InActive</span>

@else
    <span class="badge bg-danger">Deleted</span>
@endif
