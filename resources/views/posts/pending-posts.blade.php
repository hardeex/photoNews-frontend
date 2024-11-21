@extends('base.base')

@section('content')
    <div class="container">
        <h1>Pending Posts</h1>

        @if (count($postsData['posts']) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Scheduled Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postsData['posts'] as $post)
                        <tr>
                            <td>{{ $post['id'] }}</td>
                            <td><a href="{{ route('post.details', $post['slug']) }}">{{ $post['title'] }}</a></td>
                            <td>{{ ucfirst($post['status']) }}</td>
                            <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d M Y H:i') }}</td>
                            <td>{{ $post['scheduled_time'] ? \Carbon\Carbon::parse($post['scheduled_time'])->format('d M Y H:i') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                @if (isset($pagination['total']) &&
                        $pagination['total'] > 0 &&
                        isset($pagination['last_page']) &&
                        $pagination['last_page'] > 1)
                    <ul class="pagination">
                        @if (isset($pagination['prev_page_url']) && $pagination['prev_page_url'])
                            <li class="page-item">
                                <a class="page-link" href="{{ $pagination['prev_page_url'] }}">Previous</a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $pagination['last_page']; $i++)
                            <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ route('news.pending_posts', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if (isset($pagination['next_page_url']) && $pagination['next_page_url'])
                            <li class="page-item">
                                <a class="page-link" href="{{ $pagination['next_page_url'] }}">Next</a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        @else
            <p>No pending posts found.</p>
        @endif
    </div>
@endsection
