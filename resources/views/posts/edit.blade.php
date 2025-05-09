@extends('dashboard.base')

@include('dashboard.sidebar')

@section('content')
    <div
        style="max-width: 1400px; margin: 2rem auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div
            style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; background: #f8fafc; border-radius: 8px 8px 0 0; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; margin: 0;">Edit Post</h1>
            <div>
                <span
                    style="padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; margin-left: 0.5rem; background: #0dcaf0; color: white;">Views:
                    {{ $post['views'] }}</span>
                <span
                    style="padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; margin-left: 0.5rem; background: #198754; color: white;">Likes:
                    {{ $post['likes'] }}</span>
                <span
                    style="padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; margin-left: 0.5rem; background: #dc3545; color: white;">Dislikes:
                    {{ $post['dislikes'] }}</span>
                <span
                    style="padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; margin-left: 0.5rem; background: #6c757d; color: white;">Shares:
                    {{ $post['shares'] }}</span>
            </div>
        </div>

        <div style="padding: 1.5rem;">
            @if (session('error'))
                <div
                    style="padding: 1rem; border-radius: 4px; margin-bottom: 1rem; background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c;">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div
                    style="padding: 1rem; border-radius: 4px; margin-bottom: 1rem; background: #ecfdf5; border: 1px solid #10b981; color: #047857;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('update.post', $post['slug']) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
                    <!-- Main Content Column -->
                    <div style="flex: 1 1 65%; min-width: 300px;">
                        <!-- Basic Information -->
                        <div
                            style="background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; margin-bottom: 1.5rem;">
                            <div
                                style="padding: 1rem; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 600;">
                                Basic Information
                            </div>
                            <div style="padding: 1.5rem;">
                                <div style="margin-bottom: 1.25rem;">
                                    <label for="title"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Title</label>
                                    <input type="text" name="title" id="title"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                        value="{{ old('title', $post['title']) }}" required>
                                </div>

                                <div style="margin-bottom: 1.25rem;">
                                    <label for="slug"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Slug</label>
                                    <input type="text" name="slug" id="slug"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                        value="{{ old('slug', $post['slug']) }}" required>
                                </div>

                                <div style="margin-bottom: 1.25rem;">
                                    <label for="category_id"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Category</label>
                                    <select name="category_id" id="category_id"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;">
                                        <option value="">Select Category</option>
                                        <option value="{{ $post['category_id'] }}" selected>{{ $post['category_names'] }}
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <label for="content"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Content</label>
                                    <textarea name="content" id="content"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; min-height: 200px; transition: all 0.15s ease-in-out;"
                                        required>{!! old('content', $post['content']) !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div
                            style="background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; margin-bottom: 1.5rem;">
                            <div
                                style="padding: 1rem; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 600;">
                                SEO Information
                            </div>
                            <div style="padding: 1.5rem;">
                                <div style="margin-bottom: 1.25rem;">
                                    <label for="meta_title"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                        value="{{ old('meta_title', $post['meta_title']) }}">
                                </div>

                                <div>
                                    <label for="meta_description"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="meta_description"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; min-height: 100px; transition: all 0.15s ease-in-out;">{{ old('meta_description', $post['meta_description']) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Column -->
                    <div style="flex: 1 1 30%; min-width: 300px;">
                        <!-- Featured Image -->
                        <div
                            style="background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; margin-bottom: 1.5rem;">
                            <div
                                style="padding: 1rem; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 600;">
                                Featured Image
                            </div>
                            <div style="padding: 1.5rem;">
                                {{-- <input type="file" name="featured_image" id="featured_image"
                                    style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                    accept="image/*"> --}}
                                <input type="file" name="featured_image" id="featured_image"
                                    style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}"
                                        style="max-width: 100%; border-radius: 4px; margin-top: 1rem;" alt="Featured Image">
                                @endif
                            </div>
                        </div>

                        <!-- Post Settings -->
                        <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 6px;">
                            <div
                                style="padding: 1rem; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 600;">
                                Post Settings
                            </div>
                            <div style="padding: 1.5rem;">
                                <div style="margin-bottom: 1.25rem;">
                                    <label for="status"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Status</label>
                                    <select name="status" id="status"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;">
                                        <option value="published" {{ $post['status'] === 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="draft" {{ $post['status'] === 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                    </select>
                                </div>

                                <div
                                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                    @php
                                        $checkboxes = [
                                            'Featured Post' => 'is_featured',
                                            'Breaking News' => 'is_breaking',
                                            'Hot Gist' => 'hot_gist',
                                            'Event' => 'event',
                                            'Top Topic' => 'top_topic',
                                            'Pride of Nigeria' => 'pride_of_nigeria',
                                            'Allow Comments' => 'allow_comments',
                                        ];
                                    @endphp

                                    @foreach ($checkboxes as $label => $name)
                                        <label
                                            style="display: flex; align-items: center; padding: 0.5rem; background: #f9fafb; border-radius: 4px; cursor: pointer; transition: background 0.15s ease-in-out;">
                                            <input type="checkbox" name="{{ $name }}" style="margin-right: 0.5rem;"
                                                {{ old($name, $post[$name]) ? 'checked' : '' }}>
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>

                                <div style="margin: 1.25rem 0;">
                                    <label for="scheduled_time"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Schedule
                                        Publication</label>
                                    <input type="datetime-local" name="scheduled_time" id="scheduled_time"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; transition: all 0.15s ease-in-out;"
                                        value="{{ old('scheduled_time', $post['scheduled_time']) }}">
                                </div>

                                <div>
                                    <label for="review_feedback"
                                        style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #374151;">Review
                                        Feedback</label>
                                    <textarea name="review_feedback" id="review_feedback"
                                        style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 4px; min-height: 100px; transition: all 0.15s ease-in-out; background: #f9fafb;"
                                        readonly>{{ $post['review_feedback'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                    <a href="#"
                        style="padding: 0.625rem 1.25rem; border-radius: 4px; font-weight: 500; background: #6c757d; color: white; text-decoration: none; transition: background 0.15s ease-in-out;">Cancel</a>
                    <button type="submit"
                        style="padding: 0.625rem 1.25rem; border-radius: 4px; font-weight: 500; background: #0d6efd; color: white; border: none; cursor: pointer; transition: background 0.15s ease-in-out;">Update
                        Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
