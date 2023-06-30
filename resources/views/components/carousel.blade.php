@if($battles)
    @if($category)
        <a href="{{route('battles',strtolower($category->title['en']))}}">
            <div style="{{$category->style}}" class="cat_card ml-3">
                <div class="text-center category_page ">
                    {!!$category->svg!!}
                </div>
                <p class="card_category_name">{{$category->title['en']}}</p>
            </div>
        </a>
    @endif
    @forelse($battles as $battle)

        @include('user_dashboard.includes.battle_card')

    @empty
        <div class="pl-3">
            @if($carousel_user)
                    <p>No Battles! </p>
            @else
                <div class="d-flex">
                    <p>No Battles Yet! <a href="{{route('battle.create')}}" class="text-white carousel_create_link">Create your own</a></p>
                </div>
            @endif
        </div>
    @endforelse
@endif

