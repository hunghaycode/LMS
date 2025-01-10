@php
    $category = App\Models\Category::latest()->limit(6)->get();
@endphp

<section class="section featured-categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center font-title--md">Find Course with Top Categories</h2>
            </div>
        </div>

        <div class="categories categories__slider">
            @foreach ($category as $cat) 
            @php
          $course = App\Models\Course::where('category_id',$cat->id)->get();     
            @endphp
            <div class="category">
                <div class="category__img">
                    <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}"><img src="{{ asset($cat->image) }}" width="270" height="200" style="object-fit: cover" alt="images"
                           /></a>
                </div>
                <div class="category__tittle">
                    <h6><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></h6>
                    <span>{{ count($course ) }} Courses</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center">
                <a href="course-search.html" class="button button-lg button--primary">Browse all Courses</a>
            </div>
        </div>
    </div>
</section>
