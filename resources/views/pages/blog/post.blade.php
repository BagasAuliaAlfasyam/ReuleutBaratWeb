<article class="entry entry-single">
  <div class="entry-img">
    <img src="{{ url('/storage/uploads/images') . '/' . $blog->images }}" alt="{{ $blog->images }}" class="img-fluid">
  </div>

  <h2 class="entry-title">
    <a href="{{ url('/blog/detail') . '/' . $blog->slug_post }}">{{ $blog->title_post }}</a>
  </h2>

  <div class="entry-meta">
    <ul>
      <li class="d-flex align-items-center"><i class="bi bi-eye"></i>
        <span class="text-muted">{{ $blog->visit ?? 0 }}x visited</span>
      </li>
      
      <li class="d-flex align-items-center">
        <i class="bi bi-person"></i>
        
        <a href="{{ url('/blog?author=') . $blog->author->username }}">{{ $blog->author->fullname }}</a>
      </li>

      <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
        <a href="{{ url('/blog?published=') . $blog->published_at }}">
          <time datetime="2020-01-01">{{ $blog->published_at->diffForHumans() }}</time>
        </a>
      </li>
    </ul>
  </div>

  <div class="entry-content">
    {!! $blog->body_post !!}
  </div>

  <div class="entry-footer">
    <i class="bi bi-card-list"></i>
    <ul class="cats">
      <li>
        <a href="{{ url('/blog?category=') . $blog->category->slug }}">{{ $blog->category->name }}</a>
      </li>
    </ul>

    @if (!$blog->post_tag->isEmpty())
      <i class="bi bi-tags"></i>
    @endif
    
    <ul class="tags">
      @if (!$blog->post_tag->isEmpty())
        @foreach ($blog->post_tag as $tag)
          <li>
            <a href="{{ url('/blog/tags') . '/' . $tag->tag->slug_tag }}">{{ $tag->tag->name_tag }}</a>
          </li>
        @endforeach
      @endif
    </ul>
  </div>
</article>
<!-- End blog entry -->

@push('script')
  <script>
    let data = { id: {{ $blog->id }} };

    fetch("{{ url('/post/visit') }}", {
      method: "POST",
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
  </script>
@endpush
