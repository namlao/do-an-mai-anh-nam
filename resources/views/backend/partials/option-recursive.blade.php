@foreach($category->ancestors as $subCategory)
    @if($subCategory->ancestors>1)
        <option value="{{$categoryId}}">{{ $prefix }}{{$categoryName}}</option>
        @include('backend.partials.option-recursive',['categoryId'=>$category->id,'prefix'=>'--','categoryName'=>$category->name])
    @endif
@endforeach
