@foreach ($blog as $item)
    <article class="entry">

        <div class="entry-img">
            <img src="{{ url('/storage/uploads/images') . '/' . $item->images }}" alt="{{ $item->images }}"
                class="img-fluid">
        </div>

        <h2 class="entry-title">
            <a href="{{ url('/blog/detail') . '/' . $item->slug_post }}">{{ $item->title_post }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-eye"></i>
                    <span class="text-muted">{{ $item->visit ?? 0 }}x visited</span>
                </li>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                    <a href="{{ url('/blog?author=') . $item->author->username }}">{{ $item->author->fullname }}</a>
                </li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                    <a href="{{ url('/blog?published=') . $item->published_at }}">
                        <time datetime="2020-01-01">{{ $item->published_at->diffForHumans() }}</time>
                    </a>
                </li>
                <li class="d-flex align-items-center"><i class="bi bi-card-list"></i>
                    <a href="{{ url('/blog?category=') . $item->category->slug }}">
                        <span class="text-muted">{{ $item->category->name }}</span>
                    </a>
                </li>
                @if (!$item->post_tag->isEmpty())
                    @foreach ($item->post_tag as $tag)
                        <li class="d-flex align-items-center">
                            <i class="bi bi-tags"></i>
                            <a href="{{ url('/blog?tag=') . $tag->tag->slug_tag }}">
                                <span class="text-muted">{{ $tag->tag->name_tag }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="entry-content">
            <p>
                {{ \Illuminate\Support\Str::words(strip_tags($item->body_post), 40) }}
            </p>
            <div class="read-more">
                <a href="{{ url('/blog/detail') . '/' . $item->slug_post }}">Read More</a>
            </div>
        </div>

    </article><!-- End blog entry -->
@endforeach
